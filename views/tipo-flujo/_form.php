<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoFlujo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-flujo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TIFL_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TIFL_CONSTANTE')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
