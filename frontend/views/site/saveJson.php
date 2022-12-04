<?php

/** @var yii\web\View $this */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'JSON';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'options' => [
                        'class' => 'profile_form',
                        'enctype' => 'multipart/form-data',
                        'id' => 'json-form',
                    ],
            ]); ?>
            <?= $form->field($model, 'authToken')->textInput(['autofocus' => true]) ?>
            <?=$form->field($model,'requestType')->dropDownList($model::REQUEST_TYPE, ['options' => [ '1' => ['Selected' => true]]]);?>
            <?=$form->field($model,'jsonData')->fileInput(['multiple' => false,]);?>
            <div class="form-group">
                <?= Html::submitButton('Submit', ['id' => 'send-json-data', 'class' => 'btn btn-primary', 'name' => 'json-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>
