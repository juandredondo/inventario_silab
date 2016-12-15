<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoNoConsumibleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estado-no-consumible-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ESNC_ID') ?>

    <?= $form->field($model, 'ESNC_NOMBRE') ?>

    <?= $form->field($model, 'ESNC_CODIGO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
