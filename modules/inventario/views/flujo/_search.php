<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FlujoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flujo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'FLUJ_ID') ?>

    <?= $form->field($model, 'FLUJ_CANTIDAD') ?>

    <?= $form->field($model, 'MOVI_ID') ?>

    <?= $form->field($model, 'STOC_ID') ?>

    <?= $form->field($model, 'TIFU_ID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
