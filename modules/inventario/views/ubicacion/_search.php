<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UbicacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ubicacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UBIC_ID') ?>

    <?= $form->field($model, 'UBIC_ESTANTE') ?>

    <?= $form->field($model, 'UBIC_NIVEL') ?>

    <?= $form->field($model, 'UBIC_CODIGO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
