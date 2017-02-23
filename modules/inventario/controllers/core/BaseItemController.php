<?php 
    
namespace app\modules\inventario\controllers\core;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\components\core as AppCore;
use app\components\helpers\AlertHelper;

use app\config\SilabConfig;
use app\modules\inventario\models\core      as InventoryModelsCore;
use app\modules\inventario\models           as InventoryModels;
use app\components\core\ExpirableInterface;

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
     * Creates a new item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($returnUrl = "")
    {        
        $modelClass = $this->modelClass;
        $model      = new $modelClass;
        $data       = Yii::$app->request->post();

        if( $this->loadModel( $model, $data ) )
        {  
            if($model->validate() && $model->save() )
            {    
                if( $data[ "labo-default" ] == "manual" ) {
                    $return = $this->addToStock( $model );
                    
                    if($return[ "status" ] == 0 )
                        $this->setAlert( "success", $return[ "message" ] );
                    else 
                        $this->setAlert( "warning", $return[ "message" ] );
                }
                else 
                {    
                    $this->setAlert( "success", "Item registrado correctamente!" );
                }

                if( $returnUrl != "" ) {                    
                    return $this->redirect( [$returnUrl, 'id' => $model->item->id]);
                }

                return $this->redirect( ['view', 'id' => $model->item->id]);
            }
            
        }

        return $this->render( $this->viewPath . '/' . $this->viewName . '/create', [
                'model'          => $model
            ]);
    }
    
    /**
     * Updates an existing item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id from the items table, no from reactivo
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model      = $this->findModel($id);
        $data       = Yii::$app->request->post();

        if( $this->loadModel( $model, $data ) )
        {                        
            if($model->validate())
            {              
                $model->save();

                $this->setAlert( "success", "Item actualizado correctamente!" );

                return $this->redirect(['view', 'id' => $model->item->id]);
            }
        }
        
        return $this->render( $this->viewPath . '/' . $this->viewName . '/update', [
            'model'          => $model
        ]);
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

                if( $data[ "labo-default" ] == "manual" ) {
                    $return = $this->addToStock( $model );
                }
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
    public function actionUpdateByAjax($id, $returnUrl = "")
    {
        Yii::$app->response->format = \yii\web\response::FORMAT_JSON;

        $model      = $this->findModel($id);
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

                $return["message"]  = "Item actualizado correctamente";
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

    protected function addToStock( $model, $laboratory = null ) {

        $data   = Yii::$app->request->post();

        $result = [
            "message" => "Opps! no se pudo registrar en stock",
            "status"  => -1
        ];

        $laboratory = isset($laboratory) ? $laboratory : $data["Laboratorio"][ "LABO_ID" ];

        if( isset( $laboratory ) ) {
            $stockParams = [ ];

            if( $model instanceof AppCore\ConsumibleInterface ) {
               $stockParams[ "STOC_MIN" ] = $model->parent->ITCO_MIN;
               $stockParams[ "STOC_MAX" ] = $model->parent->ITCO_MAX;
            }
            else {
                $stockParams[ "STOC_MIN" ] = 1;
                $stockParams[ "STOC_MAX" ] = 1;
            }

            $result = InventoryModels\Stock::registerItemWithLaboratory($model->item, $laboratory, null, $stockParams );
            
            if( $result[ "status" ] == 0 )
                $return[ "message" ] = $result[ "message" ];
            else 
            {
                $return[ "message" ] = "Se registro el item, pero no se pudo añadir al laboratorio"; 
                $return["status"]    = 0;                       
            }
        }

        return $result;
    }

    /**
     * Finds the model model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reactivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $modelClass = $this->modelClass;

        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('No existe ese registro.');
        }
    }
}
?>