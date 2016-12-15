<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoConsumibleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estado-consumible-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ESCO_ID') ?>

    <?= $form->field($model, 'ESCO_NOMBRE') ?>

    <?= $form->field($model, 'ESCO_MIN') ?>

    <?= $form->field($model, 'ESCO_MAX') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
