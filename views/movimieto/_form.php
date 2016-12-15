<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Movimiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="movimiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MOVI_FECHA')->textInput() ?>

    <?= $form->field($model, 'MOVI_CODIGO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TIMO_ID')->textInput() ?>

    <?= $form->field($model, 'PERS_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
