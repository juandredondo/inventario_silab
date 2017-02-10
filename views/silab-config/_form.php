<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\config\SilabConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="silab-config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SILAB_VERSION')->textInput() ?>

    <?= $form->field($model, 'SILAB_PATH')->textInput() ?>

    <?= $form->field($model, 'SILAB_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SILAB_STOCK_MIN')->textInput() ?>

    <?= $form->field($model, 'SILAB_STOCK_MAX')->textInput() ?>

    <?= $form->field($model, 'SILAB_MAX_INVENTARIOS')->textInput() ?>

    <?= $form->field($model, 'createdAt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
