<?php

namespace app\modules\inventario\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\modules\inventario\models\Flujo;
use app\modules\inventario\models\TipoFlujo;
use app\modules\inventario\models\FlujoSearch;
use app\modules\inventario\models\Stock;
use app\modules\inventario\models\StockExpirado;
use app\modules\inventario\models\StockSearch;
/**
 * FlujoController implements the CRUD actions for Flujo model.
 */
class FlujoController extends Controller
{
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
                    'add-out' => ['POST'],
                ],
            ],
        ];
    }

    /**
    * Lists all Flujo models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel    = new FlujoSearch();
        $dataProvider   = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single Flujo model.
    * @param integer $id
    * @return mixed
    */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * Creates a new Flujo model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new Flujo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->FLUJ_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
    * Updates an existing Flujo model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->FLUJ_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
    * Deletes an existing Flujo model.
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
    * Finds the Flujo model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Flujo the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = Flujo::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddOut()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model          = new Flujo();
        $data           = Yii::$app->request->post();
        $allowExcess    = $data[ "allowExcess" ];
        $return = [
            "message" => "Extraccion del item correcta",
            "data"    => [],
            "status"  => 0
        ];

        if ($model->load($data)) 
        {
            // Indicamos que es una entrada
            $model->TIFU_ID         =  TipoFlujo::Salida;

            $currentAmount  = $model->stock->calculateAmount();
            $calculated     = $model->calculateWithAmount( $currentAmount );

            if( $calculated[ "hasExcess" ] )
            {
                $return[ "message" ]    = "No se puede extraer, ya que hay un exceso de <%= excess %>";
                $return[ "data" ]       = [ "excess" => $calculated[ "excess" ] ];
                $return[ "status" ]     = -1; 
            }
            else //if($allowExcess == true)
            {
                $model->FLUJ_CANTIDAD = $calculated[ "amount" ];
                // - - - - guardar - - - <-></->
                if($model->save())
                    return $return;
            }
            
            
        } 
        else 
        {
            $return[ "data" ]       = $model->getErrors();
            $return[ "message" ]    = "No se pudo extraer, hay errores";
            $return[ "status" ]     = -1; 
        }

        return $return;
    }

    public function checkFlow($flow, $type = TipoFlujo::Salida, $allowExcess = false)
    {
        $return = [
            "message" => "Extraccion del item correcta",
            "data"    => [],
            "status"  => 0
        ];

        $currentAmount  = $flow->stock->calculateAmount();
        $calculated     = $flow->calculateWithAmount( $currentAmount );

        if( $calculated[ "hasExcess" ] )
        {
            $return[ "message" ]    = "No se puede extraer, ya que hay un exceso de <%= excess %>";
            $return[ "data" ]       = [ "excess" => $calculated[ "excess" ] ];
            $return[ "status" ]     = -1; 
        }
    }

    public function actionAddEntry()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $model  = new Flujo();
        $data   = Yii::$app->request->post();
        $return = [
            "message" => "Ingreso del item correcto.",
            "data"    => [],
            "status"  => 0
        ];

        if ($model->load($data)) 
        {
            // Indicamos que es una entrada
            $model->TIFU_ID         =  TipoFlujo::Entrada;
            
            if($model->save())
            {
                if( $model->isExpirable )
                {
                    $vencimiento = new StockExpirado([
                        "FLUJ_ID"               => $model->FLUJ_ID,
                        "STVE_FECHAVENCIMIENTO" => $data[ "StockExpirado" ][ "STVE_FECHAVENCIMIENTO" ]
                    ]);

                    if( $vencimiento->save() )
                        $return[ "message" ] = $return[ "message" ] . "<b> Se ingresó a la pila FI-FO la nueva fecha de caducación. </b>";
                }

                return $return;
            }
        } 
        else 
        {
            $return[ "data" ]       = $model->getErrors();
            $return[ "message" ]    = "No se pudo extraer, hay errores";
            $return[ "status" ]     = -1; 
        }

        return $return;
    }

    public function beforeAction($action) 
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIsExpirableStock($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $flow = new Flujo([
            "STOC_ID" => $id
        ]);
        
        return [
            "result" => $flow->isExpirable
        ];
    }

    public function actionForward()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $session                    = Yii::$app->session;  
        
        return $session->getFlash('stock-data', [ "message" => "Jeanca was here!" ]);
    }
}
