<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\DetalleSolicitudSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalle-solicitud-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'DESO_ID') ?>

    <?= $form->field($model, 'DESO_CANTIDAD') ?>

    <?= $form->field($model, 'SOLI_ID') ?>

    <?= $form->field($model, 'STOC_ID') ?>

    <?= $form->field($model, 'DESO_VALIDO')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
