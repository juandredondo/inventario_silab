<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CaducidadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="caducidad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CADU_ID') ?>

    <?= $form->field($model, 'CADU_NOMBRE') ?>

    <?= $form->field($model, 'CADU_MIN') ?>

    <?= $form->field($model, 'CADU_MAX') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
