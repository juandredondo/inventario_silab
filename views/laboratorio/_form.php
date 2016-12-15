<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Laboratorio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="laboratorio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'LABO_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LABO_NIVEL')->textInput() ?>

    <?= $form->field($model, 'EDIF_ID')->textInput() ?>

    <?= $form->field($model, 'COOR_ID')->textInput() ?>

    <?= $form->field($model, 'TILA_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
