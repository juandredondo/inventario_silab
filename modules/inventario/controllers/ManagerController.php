<?php 
    
namespace app\modules\inventario\controller;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// ---- Modelos ----
use app\modules\inventario\models\Accesorios;
use app\modules\inventario\models\AccesoriosSearch;

class ManagerController extends Controller
{
    public function actionIndex()
    {
        return "";
    }
}
?>