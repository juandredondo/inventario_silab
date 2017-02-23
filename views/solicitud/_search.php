<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SolicitudSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitud-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'SOLI_ID') ?>

    <?= $form->field($model, 'SOLI_FECHA') ?>

    <?= $form->field($model, 'SOLI_CODIGO') ?>

    <?= $form->field($model, 'TISO_ID') ?>

    <?= $form->field($model, 'ESSO_ID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
