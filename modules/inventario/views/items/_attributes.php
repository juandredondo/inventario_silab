<?php 

use app\components\ArrayHelperFilter;

$separator = isset($separator) ? $separator : "";

$relation = isset($relation) ? $relation : [ "item" => "" ];

return ArrayHelperFilter::merge(
            ArrayHelperFilter::addPrefix(
                ArrayHelperFilter::remove($item->attributes(), ["MARC_ID", "TIIT_ID"]),
                $relation[ "item" ]
            ),
            [
                [
                    "attribute" => $relation[ "item" ] . $separator. "MARC_ID",
                    "value"     => $item->marca->MARC_NOMBRE
                ],
                [
                    "attribute" => $relation[ "item" ] . $separator. "TIIT_ID",
                    "value"     => $item->tipoItem->TIIT_NOMBRE
                ]
            ]
        );


?>