<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccesoriosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accesorios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ACCE_ID') ?>

    <?= $form->field($model, 'ACCE_SERIAL') ?>

    <?= $form->field($model, 'ACCE_MODELO') ?>

    <?= $form->field($model, 'ITNC_ID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
