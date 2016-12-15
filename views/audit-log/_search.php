<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuditLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audit-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AULOG_ID') ?>

    <?= $form->field($model, 'AULOG_TABLENAME') ?>

    <?= $form->field($model, 'AULOG_FECHA') ?>

    <?= $form->field($model, 'USUA_ID') ?>

    <?= $form->field($model, 'LOTI_ID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
