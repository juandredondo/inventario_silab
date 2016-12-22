<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TIIT_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TIIT_PADRE')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
