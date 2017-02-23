<?php 
    
namespace app\modules\inventario\controllers\core;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

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

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'create-by-ajax' => ['POST'],
                    'update-by-ajax' => ['POST'],
                ],
            ],
        ];
    }

    /**
    * Carga el formulario para el tipo de item
    * @param string $returnUrl La url a redireccionar. Si no se especifica, se devuelve la url de
    * detalles del item
    * @param boolean $isAjax Indica si la peticion es ajax o no
    */
    public function actionLoadform( $returnUrl = "", $isAjax = true )
    {
        $modelClass = $this->modelClass;
        $model      = new $modelClass;

        return $this->renderAjax($this->viewPath. '/'. $this->viewName .'/create', [
                'model'     => $model,
                'returnUrl' => $returnUrl,
                'isAjax'    => $isAjax
            ]);
    }

    /**
    * Establece un alert para el navegador y mandar un mensaje
    * @param integer $type El tipo de alert que se generara
    * @param string $message El contenido o mensaje del alert para el usuario
    * @param string $key El identificador del alert en el navegador, si no se especifica
    * se usa el valor por defecto. Vease [DEFAULT_KEY] en AlertHelper
    */
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

    /**
    * Permite registrar un item por ajax
    * @param string $returnUrl La url a redireccionar. Si no se especifica, se devuelve la url de
    * detalles del item
    */
    public function actionCreateByAjax($returnUrl = "")
    {
        Yii::$app->response->format = \yii\web\response::FORMAT_JSON;

        $modelClass = $this->modelClass;
        $model      = new $modelClass;
        $data       = Yii::$app->request->post();
        $return     = [];

        if( $this->loadModel( $model, $data ) )
        {     
            if($model->validate() && $model->save() )
            {              
                if($returnUrl != "" )
                    $return["location"] = $returnUrl;
                else 
                    $return["location"] = Url::toRoute(['view', 'id' => $model->id]);

                $return["message"]  = "Item registrado correctamente";
                $return["status"]   = 0;
            }
        }
        else
        {
            $return["message"]  = "Errores!";
            $return["status"]   = -1;
        }
        
        $model->item->TIIT_ID   = $model::getType();

        $return["model"] = $model;
        return $return;
    }

    /**
    * Permite actualizar un item por ajax
    * @param string $returnUrl La url a redireccionar. Si no se especifica, se devuelve la url de
    * detalles del item
    */
    public function actionUpdateByAjax($returnUrl = "")
    {
        Yii::$app->response->format = \yii\web\response::FORMAT_JSON;

        $modelClass = $this->modelClass;
        $model      = new $modelClass;
        $data       = Yii::$app->request->post();
        $return     = [];

        if( $this->loadModel( $model, $data ) )
        {     
            if($model->validate() && $model->save() )
            {              
                if($returnUrl != "" )
                    $return["location"] = $returnUrl;
                else 
                    $return["location"] = Url::toRoute(['view', 'id' => $model->id]);

                $return["message"]  = "Item registrado correctamente";
                $return["status"]   = 0;
            }
            else
            {
                $return["message"]  = "Errores!";
                $return["status"]   = -1;
            }
        }
        
        $item->TIIT_ID   = $modelClass::getType();

        $return["model"] = $model;
        
        return $return;
    }

    /**
    * Carga el item modelo con la informacion
    * @param ActiveRecord $model The item model to load the data
    * @param array $data The data-array for loading the models, commonly "post-data"
    * @param array $formNames The formNames for each model (item, parent and current submodel)
    */
    public function loadModel($model, $data, $formNames = [])
    {
        $itemFormName   = isset($formNames[ "item" ])   ? $formNames[ "item" ]      : $model->item->formName();
        $parentFormName = isset($formNames[ "parent" ]) ? $formNames[ "parent" ]    : $model->parent->formName();
        $modelFormName  = isset($formNames[ "model" ])  ? $formNames[ "model" ]     : $model->formName();
                
        return $data != null && 
                $model->item->load($data, $itemFormName ) &&
                    $model->parent->load($data, $parentFormName ) &&
                        $model->load($data, $modelFormName );
    }
    

    /**
    * Permite borrar un item, esta accion debe sobreescribirse
    */
    public function actionDelete()
    {
        return new yii\base\NotSupportedException( "No está implementada esta funcionalidad, debe ser sobreescrita" );
    }
}
?>