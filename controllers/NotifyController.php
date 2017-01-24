<?php 
namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\components\Notification;
use app\models                      as Models;
use app\modules\inventario\models   as InvModels;
use app\modules\admin\models        as LoginModels;

class NotifyController extends Controller
{
    public function actionNotifyItemEmpty()
    {
        $data = Yii::$app->request->post();

        if(!empty($data)) {

            $inventory  = InvModels\Inventario::findOne($data[ "inventory" ][ "id" ]);
            $laboratory = $inventory->laboratorio;

            $usuarios = $laboratory->cuentasFuncionarios;
            /*
            Notification::warning(Notification::KEY_EMPTY_ITEMS, 
                    
                    $data[ "inventory-id" ]
            );
            */
            return [ "status" => 0, "stocks" => $usuarios ];
        }

        return [ "status" => -1 ];
    }
}
?>