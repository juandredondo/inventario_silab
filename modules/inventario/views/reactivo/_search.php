<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReactivoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reactivo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'REAC_ID') ?>

    <?= $form->field($model, 'REAC_CODIGO') ?>

    <?= $form->field($model, 'REAC_UNIDAD') ?>

    <?= $form->field($model, 'REAC_FECHA_VENCIMIENTO') ?>

    <?= $form->field($model, 'ITCO_ID') ?>

    <?php // echo $form->field($model, 'UBIC_ID') ?>

    <?php // echo $form->field($model, 'CADU_ID') ?>

    <?php // echo $form->field($model, 'SIMB_ID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
