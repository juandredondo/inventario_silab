<?php 
    
namespace app\components\core\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

    public function actionLoadform()
    {
        $modelClass = $this->modelClass;

        return $this->renderAjax($this->viewPath. '/'. $this->viewName .'/create', [
                'model' => new $modelClass
            ]);
    }
}
?>