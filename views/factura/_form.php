<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Factura */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FACT_CODIGO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FACT_FECHA')->textInput() ?>

    <?= $form->field($model, 'FACT_IMAGEPATH')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PROV_ID')->textInput() ?>

    <?= $form->field($model, 'PEDI_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
