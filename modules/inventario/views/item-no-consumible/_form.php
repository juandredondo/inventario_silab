<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemNoConsumible */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-no-consumible-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        require Yii::getAlias('@inventarioViews').'/item-no-consumible/_form-fields.php';
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
