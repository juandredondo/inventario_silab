<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reactivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reactivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'REAC_CODIGO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REAC_UNIDAD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REAC_FECHA_VENCIMIENTO')->textInput() ?>

    <?= $form->field($model, 'ITCO_ID')->textInput() ?>

    <?= $form->field($model, 'UBIC_ID')->textInput() ?>

    <?= $form->field($model, 'CADU_ID')->textInput() ?>

    <?= $form->field($model, 'SIMB_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
