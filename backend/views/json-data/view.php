<?php

use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\JsonData $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Json Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="json-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'date_create',
            'date_update',
        ],
    ]) ?>
    <h2>JSON Data</h2>
    <?php
    echo '<pre>';
//    print_r($model->data);
//    print_r($model->preparedJsonArr);
    echo '</pre>';
        echo \wbraganca\fancytree\FancytreeWidget::widget([
            'options' =>[
                'source' => $model->preparedJsonArr,
                'extensions' => ['dnd'],
                'dnd' => [
                    'preventVoidMoves' => true,
                    'preventRecursiveMoves' => true,
                    'autoExpandMS' => 400,
                ],
            ]
        ]);
    ?>
</div>
