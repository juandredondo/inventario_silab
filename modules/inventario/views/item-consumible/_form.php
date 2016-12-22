<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemConsumible */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-consumible-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ITEM_ID')->textInput() ?>

    <?= $form->field($model, 'estadoConsumible_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
