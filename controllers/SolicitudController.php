<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

use app\components\core             as AppCore;
use app\modules\inventario\models   as InventoryModels;

use app\models                      as Models;
use app\models\Solicitud;
use app\models\SolicitudSearch;

/**
 * SolicitudController implements the CRUD actions for Solicitud model.
 */
class SolicitudController extends Controller
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
     * Lists all Solicitud models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new SolicitudSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Solicitud model.
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
     * Creates a new Solicitud model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $searchModel    = new InventoryModels\views\StockActualSearch();
        $dataProvider   = $searchModel->search(Yii::$app->request->queryParams);
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -        
        $model          = new Solicitud();
        $detailItems    = [ new Models\DetalleSolicitud() ];
        $data           = Yii::$app->request->post();

        if ($model->load( $data )) {
            // Attach the init state for the Request
            $model->ESSO_ID = Models\EstadoSolicitud::getInitState()->ESSO_ID;
            
            // Load the stock items
            $detailItems = AppCore\Model::createMultiple( Models\DetalleSolicitud::classname() );
            AppCore\Model::loadMultiple( $detailItems, $data );
            
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple( $detailItems ),
                    ActiveForm::validate( $model )
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = AppCore\Model::validateMultiple( $detailItems ) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {

                        foreach ($detailItems as $detailItem) {
                            $detailItem->setDefaultScenario();
                            $detailItem->SOLI_ID  = $model->id;

                            if (! ($flag = $detailItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {

                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

                return $this->redirect([ 'view', 'id' => $model->id ]);
            }

        } 


        return $this->render('create', [
            'model'         => $model,
            'detailItems'   => (empty($detailItems)) ? [ new Models\DetalleSolicitud() ] : $detailItems,
            'items'         => InventoryModels\views\VStockActual::find()->all(),
            // - - - - - - - - - - - - - - 
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Solicitud model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $searchModel    = new InventoryModels\views\StockActualSearch();
        $dataProvider   = $searchModel->search(Yii::$app->request->queryParams);
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        $model       = $this->findModel($id);
        $detailItems = $model->detalles;
        $data        = Yii::$app->request->post();

        if ($model->load( $data )) {
                       

            $oldIDs         = ArrayHelper::map( $detailItems, 'id', 'id' );
            $detailItems    = AppCore\Model::createMultiple(Models\DetalleSolicitud::classname(), $detailItems);
                              AppCore\Model::loadMultiple( $detailItems, $data );

            $deletedIDs     = array_diff($oldIDs, array_filter( ArrayHelper::map($detailItems, 'id', 'id') ));         
            
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple( $detailItems ),
                    ActiveForm::validate( $model )
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = AppCore\Model::validateMultiple( $detailItems ) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        
                        if (! empty($deletedIDs)) {
                            Models\DetalleSolicitud::deleteAll(['id' => $deletedIDs]);
                        }

                        foreach ($detailItems as $detailItem) {
                            $detailItem->setDefaultScenario();
                            $detailItem->SOLI_ID  = $model->id;

                            if (! ($flag = $detailItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {

                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

                return $this->redirect([ 'view', 'id' => $model->id ]);
            }

        }

        return $this->render('update', [
            'model'         => $model,
            'detailItems'   => (empty($detailItems)) ? [ new Models\DetalleSolicitud() ] : $detailItems,
            'items'         => InventoryModels\views\VStockActual::find()->all(),
            // - - - - - - - - - - - - - - 
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Solicitud model.
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
     * Finds the Solicitud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Solicitud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Solicitud::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
