<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'FACT_ID') ?>

    <?= $form->field($model, 'FACT_CODIGO') ?>

    <?= $form->field($model, 'FACT_FECHA') ?>

    <?= $form->field($model, 'FACT_IMAGEPATH') ?>

    <?= $form->field($model, 'PROV_ID') ?>

    <?php // echo $form->field($model, 'PEDI_ID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
