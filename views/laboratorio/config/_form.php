<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LaboratorioConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="laboratorio-config-form">

    <?php $form = ActiveForm::begin([ "action" => [ $model->isNewRecord ? 'add-config' : 'update-config'  ] ]); ?>

    <p>Stock minimo y maximo para cada item.</p>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'LACO_STOCKMIN')->textInput([ "type" => "number" ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'LACO_STOCKMAX')->textInput([ "type" => "number" ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'LABO_ID')->textInput(
        [
            "type" => "hidden", 'readonly' => false
        ]
        )->label(false) 
    ?>

    <?= $form->field($model, 'PERI_ID')->textInput(
        [
            "type" => "hidden", 'readonly' => false 
        ]
        )->label(false) 
    ?>

    <?// $form->field($model, 'TIIT_ID')->textInput() ?>

    <?= $form->field($model, 'LACO_MAXINVENTARIOS')->textInput([ "type" => "number" ]) ?>

    <?php //$form->field($model, 'LACO_EXTRADATA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton("Guardar cambios", ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
