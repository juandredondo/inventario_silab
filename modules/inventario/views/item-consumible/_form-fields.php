<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\core\EstadoConsumible;

/* @var $this yii\web\View */
/* @var $model app\models\ItemConsumible */
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
                    "main"  => $itemConsumible,
                    "ref"   => EstadoConsumible::className()
                ],
                "columns"   => [
                    "id"    =>  "ESCO_ID",
                    "text"  =>  "ESCO_NOMBRE"
                ]
            ]
        ); 
    ?>
