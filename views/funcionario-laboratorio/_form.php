<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FuncionarioLaboratorio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funcionario-laboratorio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FUNC_ID')->textInput() ?>

    <?= $form->field($model, 'LABO_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
