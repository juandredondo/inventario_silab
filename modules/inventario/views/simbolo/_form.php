<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Simbolo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="simbolo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SIMB_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SIMB_CODIGO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
