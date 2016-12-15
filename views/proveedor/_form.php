<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Provedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PROV_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROV_NIT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
