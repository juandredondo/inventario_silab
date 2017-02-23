<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\core\EstadoConsumible;
use app\config\SilabConfig;
/* @var $this yii\web\View */
/* @var $model app\models\ItemConsumible */
/* @var $form yii\widgets\ActiveForm */
$silabConfig = SilabConfig::getCurrentConfig();

?>
    <?php 
        if(!$isJustLoad && isset($item))
            require Yii::getAlias('@inventarioViews').'/items/_form-fields.php';
        
        $fields[ "itemConsumible-ESCO_ID" ] = DropDownWidget::widget(
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

        $fields[ "itemConsumible-MINMAX" ] = $this->render(
            "@inventarioViews/item-consumible/_min-max-fields", [ 
                "itemConsumible"    => $itemConsumible, 
                "form"              => $form,
                "silabConfig"       => $silabConfig
            ]);
    ?>
    

    

