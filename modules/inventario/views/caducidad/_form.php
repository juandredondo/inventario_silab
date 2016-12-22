<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Caducidad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="caducidad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CADU_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CADU_MIN')->textInput() ?>

    <?= $form->field($model, 'CADU_MAX')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
