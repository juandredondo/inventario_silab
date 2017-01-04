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
                ArrayHelperFilter::remove($itemConsumible->attributes(), ["ESCO_ID", "ITEM_ID"]),
                $relation[ "parent" ]
            ),
            [
                [
                    "attribute" => $relation[ "parent" ] . $separator . "ESNC_ID",
                    "value"     => $itemConsumible->estadoConsumible->ESCO_NOMBRE
                ]
            ]
        );
?>