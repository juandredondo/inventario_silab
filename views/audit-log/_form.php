<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuditLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audit-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AULOG_TABLENAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AULOG_FECHA')->textInput() ?>

    <?= $form->field($model, 'USUA_ID')->textInput() ?>

    <?= $form->field($model, 'LOTI_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
