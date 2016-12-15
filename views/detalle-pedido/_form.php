<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetallePedido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalle-pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DEPE_CANTIDAD')->textInput() ?>

    <?= $form->field($model, 'PEDI_ID')->textInput() ?>

    <?= $form->field($model, 'ITEM_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
