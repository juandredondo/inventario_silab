<?php 
    
namespace app\components\core\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\components\helpers\AlertHelper;

use app\config\SilabConfig;
use app\modules\inventario\models\core as InventoryModelsCore;

class BaseItemController extends Controller
{
    public $viewPath    = "@inventarioViews";
    public $modelClass  = "";
    public $viewName    = "";

    public function init()
    {
        if($this->viewName === "")
            throw new \yii\base\InvalidConfigException("Controlador debe implementar propiedad \"viewName\"");
        if($this->modelClass === "")
            throw new \yii\base\InvalidConfigException("Controlador debe implementar el nombre del modelo em \"modelClass\"");
        parent::init();
    }

    public function actionLoadform($returnUrl = "")
    {
        $modelClass = $this->modelClass;
        $model      = new $modelClass;

        return $this->renderAjax($this->viewPath. '/'. $this->viewName .'/create', [
                'model'     => $model,
                'returnUrl' => $returnUrl
            ]);
    }

    public function setAlert($type, $message, $key = null)
    {
        switch($type)
        {
            case "success":
                AlertHelper::success($message, $key);
            break;

            case "danger":
                AlertHelper::danger($message, $key);
            break;

            case "warning":
                AlertHelper::warning($message, $key);
            break;

            case "error":
                AlertHelper::error($message, $key);
            break;

            case "info":
                AlertHelper::info($message, $key);
            break;

            default:
                AlertHelper::info($message, $key);
            break;
        }
    }
}
?>