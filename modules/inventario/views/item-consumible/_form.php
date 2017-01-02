<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemConsumible */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-consumible-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        require Yii::getAlias('@inventarioViews').'/item-consumible/_form-fields.php';
    ?>

    <div class="form-group">
        <?= Html::submitButton($itemConsumible->isNewRecord ? 'Create' : 'Update', ['class' => $itemConsumible->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
