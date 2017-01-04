<?php 

use app\components\ArrayHelperFilter;

$separator = ".";
if(is_subclass_of($model, app\modules\inventario\models\core\ItemBase::className()))
{
    $relation = $model->getRelationPath(".");
}
else
{
    $relation   = isset($relation) ? $relation : [ "item" => "item", "parent" => ""];
    $separator  = "";
}

$attributes = require (Yii::getAlias('@inventarioViews').'/items/_attributes.php');

return ArrayHelperFilter::merge(
            $attributes,
            ArrayHelperFilter::addPrefix(
                ArrayHelperFilter::remove($itemNoConsumible->attributes(), ["ESNC_ID", "MODE_ID", "ITEM_ID"]),
                $relation[ "parent" ]
            ),
            
            [
                [
                    "attribute" => $relation[ "parent" ]. $separator .  "ESNC_ID",
                    "value"     => $itemNoConsumible->estadoNoConsumible->ESNC_NOMBRE
                ],
                [
                    "attribute" => $relation[ "parent" ] . $separator . "MODE_ID",
                    "value"     => $itemNoConsumible->modelo->MODE_CODIGO
                ]
            ]
        );
?>