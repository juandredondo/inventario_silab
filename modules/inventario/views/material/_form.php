<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
    // variable para imprimir el boton tambien
    $submitButton   = (isset($submitButton))    ? $submitButton : true;  
    $isJustLoad     = (isset($isJustLoad))      ? $isJustLoad   : false;
    $item           = $model->item;
    $itemConsumible = $model->parent;
?>
<div class="material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        require Yii::getAlias("@inventarioViews").'/item-consumible/_form-fields.php';
    ?>

    <?= $form->field($model, 'MATE_MEDIDA')->textInput(['maxlength' => true]) ?>

    <?// $form->field($model, 'ITCO_ID')->textInput() ?>
    
    <?php if($submitButton): ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endIf; ?>

    <?php ActiveForm::end(); ?>

</div>
