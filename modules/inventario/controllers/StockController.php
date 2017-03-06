<?php

namespace app\modules\inventario\controllers;

use Yii;
use app\models\Periodo;
use app\modules\inventario\models   as InventoryModels; 
use app\components                  as AppComponents;
use app\components\helpers\AlertHelper;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StockController implements the CRUD actions for Stock model.
 */
class StockController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all Stock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new InventoryModels\views\StockActualSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stock model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionInitializeInventory($id)
    {
        $data = Yii::$app->request->post();
    }

    /**
     * Creates a new Stock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd($inventory = "", $laboratory = "")
    {
        
        $stock      = new InventoryModels\Stock();
        $flujo      = new InventoryModels\Flujo();
        $data       = Yii::$app->request->post();
        $message    = "Añadido a Stock!";

        $return     = [
            "redirect" => ['/inventario/inventario/view' ]
        ];


        if ($stock->load($data) ) 
        {
            if($data[ "manual-period" ] === "auto")
                $stock->PERI_ID = Periodo::getCurrentPeriod()->PERI_ID;
            
            try {

                if($stock->save()){
                    $flujo->STOC_ID         =  $stock->STOC_ID;
                    $flujo->FLUJ_CANTIDAD   =  $stock->STOC_CANTIDAD;
                    $flujo->TIFU_ID         =  InventoryModels\TipoFlujo::Entrada;
                    $flujo->PERI_ID         =  $stock->PERI_ID;

                    if($flujo->save())
                    {
                        if($data["is-expirable"] == "true" )
                        {
                            $vencimiento = new InventoryModels\StockExpirado([
                                "FLUJ_ID"               => $flujo->FLUJ_ID,
                                "STVE_FECHAVENCIMIENTO" => $data[ "StockExpirado" ][ "FECHAVENCIMIENTO" ]
                            ]);

                            if($vencimiento->save())
                            {
                                $message = "Añadido a Stock!, este item es expirable por tanto se agrego a la pila FIFO";
                            }
                        }

                        AlertHelper::success($message);
                        
                        $return[ "redirect" ][ "id" ] = $stock->INVE_ID;

                        if($stock->inventario->isSingleton) {
                            $return[ "redirect" ][ "laboratory" ] = $stock->LABO_ID;
                        }

                        return $this->redirect( $return[ "redirect" ] );
                    }
                }
            
            } catch (\yii\db\Exception $e) {
                AlertHelper::danger("Opps!" . $e->name );
            }
            
        }    
        
        return $this->render('create', [
                'stock' => $stock,
                'flujo' => $flujo,
            ]);
    }

    /**
     * Creates a new Stock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddByAjax($inventory = "", $laboratory = "", $redirect = "")
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $stock          = new InventoryModels\Stock();
        $flujo          = new InventoryModels\Flujo();
        $data           = Yii::$app->request->post();
        $hasRedirect    = $redirect != "";
        
        // - - - Resultado para ajax - - - 
        $result     = AppComponents\AjaxResult::create();
      
        if ($stock->load($data) ) 
        {
            if($data[ "manual-period" ] === "auto")
                $stock->PERI_ID = Periodo::getCurrentPeriod()->PERI_ID;
            
            try {

                if($stock->save()){
                    $flujo->STOC_ID         =  $stock->STOC_ID;
                    $flujo->FLUJ_CANTIDAD   =  $stock->STOC_CANTIDAD;
                    $flujo->TIFU_ID         =  InventoryModels\TipoFlujo::Entrada;
                    $flujo->PERI_ID         =  $stock->PERI_ID;

                    if($flujo->save())
                    {
                        $result->message("Añadido a Stock!")
                               ->status( AppComponents\AjaxResult::STATUS_OK );

                        if($data["is-expirable"] == "true" )
                        {
                            $vencimiento = new InventoryModels\StockExpirado([
                                "FLUJ_ID"               => $flujo->FLUJ_ID,
                                "STVE_FECHAVENCIMIENTO" => $data[ "StockExpirado" ][ "FECHAVENCIMIENTO" ]
                            ]);

                            if($vencimiento->save())
                            {
                                $result->message("Añadido a Stock!, este item es expirable por tanto se agrego a la pila FIFO");
                            }
                            else {
                                $result->status( AppComponents\AjaxResult::STATUS_WARNING )
                                       ->message( "Se registro en Stock, pero no en expiracion" );
                            }
                        }

                        $result->action( $hasRedirect ? 
                                            AppComponents\AjaxResult::ACTION_REDIRECT : 
                                            AppComponents\AjaxResult::ACTION_REFRESH,  
                                        $hasRedirect ?  Url::toRoute([ $redirect ]) : null 
                                );

                    }
                }
            
            } catch (\yii\db\Exception $e) {
                $result->status( AppComponents\AjaxResult::STATUS_BAD )
                       ->message( "Oops! hubo un error en el proceso." );
            }
            
        }    
        
        return $result;
    }

    /**
     * Updates an existing Stock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->STOC_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Stock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $fromInventory = false)
    {
        $this->findModel($id)->delete();

        if(!$fromInventory)
            return $this->redirect(['index']);
        else
            return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
    }

    /**
     * Finds the Stock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InventoryModels\Stock::findOne($id)) !== null) {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetEmptyItems()
    {
        return \app\modules\inventario\models\Stock::getEmptyItems();
    }

    public function actionAddItemsToStock() {
        
    }
}
