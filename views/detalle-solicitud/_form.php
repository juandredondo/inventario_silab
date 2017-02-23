<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleSolicitud */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalle-solicitud-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DESO_CANTIDAD')->textInput() ?>

    <?= $form->field($model, 'SOLI_ID')->textInput() ?>

    <?= $form->field($model, 'STOC_ID')->textInput() ?>

    <?= $form->field($model, 'DESO_VALIDO')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
