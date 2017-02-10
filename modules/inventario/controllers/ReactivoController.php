<?php

namespace app\modules\inventario\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

use app\config\SilabConfig;
use app\components\core\controllers\BaseItemController;

use app\modules\inventario\models\core\Items;
use app\modules\inventario\models\core\ItemConsumible;
use app\modules\inventario\models\core\TipoItem;
use app\modules\inventario\models\core\EstadoConsumible;
use app\modules\inventario\models\Caducidad;
use app\modules\inventario\models\Reactivo;
use app\modules\inventario\models\ReactivoSearch;

/**
 * ReactivoController implements the CRUD actions for Reactivo model.
 */
class ReactivoController extends BaseItemController
{
    public $modelClass = "app\modules\inventario\models\Reactivo";
    public $viewName   = "reactivo";
    /**
     * @inheritdoc
     */
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
     * Lists all Reactivo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReactivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reactivo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $modelClass = $this->modelClass;

        return $this->render('view', [
            'model' => $modelClass::getByItemId($id),
        ]);
    }

    /**
     * Creates a new Reactivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($returnUrl = "")
    {        
        $reac = new \app\modules\inventario\models\Reactivo();
        $data = Yii::$app->request->post();

        if($data != null && 
                $reac->item->load($data, 'Items') &&
                    $reac->parent->load($data, 'ItemConsumible') &&
                        $reac->load($data, 'Reactivo')
          )
        {  
                
            if($reac->validate() && $reac->save() )
            {              
                if( $returnUrl != "" ) { 
                    return $this->redirect( [$returnUrl, 'id' => $reac->item->id]);
                }

                return $this->redirect( ['view', 'id' => $reac->item->id]);
            }
            
        }

        
        return $this->render('/reactivo/create', [
                'model'          => $reac
            ]);
    }

    public function actionCreateByAjax()
    {
        Yii::$app->response->format = \yii\web\response::FORMAT_JSON;

        $reac   = new \app\modules\inventario\models\Reactivo();
        $data   = Yii::$app->request->post();
        $return = [];

        if($data != null && 
                $reac->item->load($data, 'Items') &&
                    $reac->parent->load($data, 'ItemConsumible') &&
                        $reac->load($data, 'Reactivo')
          )
        {     
            if($reac->validate() && $reac->save() )
            {              
                $return["location"] = Url::toRoute(['view', 'id' => $reactivo->id]);
                $return["message"]  = "Item registrado correctamente";
                $return["status"]   = "OK";
            }
        }
        
        $item->TIIT_ID = TipoItem::Reactivo;

        $return["model"] = $reactivo;
        $return["item"]  = $item;

        return $return;
    }
    
    /**
     * Updates an existing Reactivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id from the items table, no from reactivo
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $reac       = $this->findModel($id);
        //$reac->fillParents();
        $data       = Yii::$app->request->post();

        if($data != null && 
                $reac->item->load($data, 'Items') &&
                    $reac->parent->load($data, 'ItemConsumible') &&
                        $reac->load($data, 'Reactivo')
          )
        {            
            // calculamos el Caducado
            $reac->CADU_ID  = Caducidad::getCaducado( $reac->REAC_FECHA_VENCIMIENTO )->CADU_ID;
            
            if($reac->validate())
            {              
                $reac->save();
                return $this->redirect(['view', 'id' => $reac->item->id]);
            }
        }
        
        return $this->render('/reactivo/update', [
            //'item'           => $reac->item,
            //'itemConsumible' => $reac->parent,
            'model'          => $reac
        ]);
    }

    /**
     * Deletes an existing Reactivo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reactivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reactivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reactivo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function loadForm()
    {

    }
}
