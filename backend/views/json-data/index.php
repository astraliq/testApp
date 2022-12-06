<?php

use common\models\JsonData;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\JsonDataSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Json Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="json-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, JsonData $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
            'id',
            'user_id',
            [
                'attribute' => 'title',
                'label' => 'JSON Data',
                'headerOptions' => ['style' => 'width:50%'],
                'value' => function($model) {
                    $jsonData = substr($model->data,0,150);
                    return strlen($model->data) <= 150 ? $jsonData : $jsonData . "...";
                },
            ],
            'date_create',
            'date_update',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
