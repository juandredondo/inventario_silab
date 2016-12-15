<?php

namespace app\components;

use Yii;
use yii\helpers\ArrayHelper;

class ArrayHelperFilter
{
    public static function filter($model, $columns)
    {
        return ArrayHelper::map($model::find()->all(), $columns[ "value" ], $columns[ "text" ]);
    }
}

?>