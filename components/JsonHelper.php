<?php

namespace app\components;

use Yii;
use yii\helpers\Json;

class JsonHelper
{
    public static function renderJSON($data)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public static function giveResponse($options)
    {
        $response   = \Yii::$app->response;
        $headers    = $response->getHeaders();

        $response->setStatusCode($options[ "code" ]);

        $optC = count($options[ "headers" ]);
        for($i = 0; $i < $optC; $i++)
        {
            $headers->set($options[ "headers" ][ $i ][ "name" ], $options[ "headers" ][ $i ][ "value" ]);
        }
    }
}


?>