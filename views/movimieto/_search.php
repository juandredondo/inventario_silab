<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MovimientoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="movimiento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'MOVI_ID') ?>

    <?= $form->field($model, 'MOVI_FECHA') ?>

    <?= $form->field($model, 'MOVI_CODIGO') ?>

    <?= $form->field($model, 'TIMO_ID') ?>

    <?= $form->field($model, 'PERS_ID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
