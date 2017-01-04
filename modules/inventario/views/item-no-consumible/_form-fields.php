<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\core\EstadoNoConsumible;
use app\modules\inventario\models\Modelo;
/* @var $this yii\web\View */
/* @var $model app\models\ItemNoConsumible */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php 
        if(!$isJustLoad && isset($item))
            require Yii::getAlias('@inventarioViews').'/items/_form-fields.php';
    ?>

    <?= DropDownWidget::widget(
            [
                "form"  =>  $form,
                "model" =>  [
                    "main"  => $itemNoConsumible,
                    "ref"   => EstadoNoConsumible::className()
                ],
                "columns"   => [
                    "id"    =>  "ESNC_ID",
                    "text"  =>  "ESNC_NOMBRE"
                ]
            ]
        ); 
    ?>
    
    <?= DropDownWidget::widget(
            [
                "form"  =>  $form,
                "model" =>  [
                    "main"  => $itemNoConsumible,
                    "ref"   => Modelo::className()
                ],
                "columns"   => [
                    "id"    =>  "MODE_ID",
                    "text"  =>  "MODE_CODIGO"
                ]
            ]
        ); 
    ?>
