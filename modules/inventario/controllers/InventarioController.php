<?php

namespace app\modules\inventario\controllers;

use Yii;
use app\modules\inventario\models\Inventario;
use app\modules\inventario\models\InventarioSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InventarioController implements the CRUD actions for Inventario model.
 */
class InventarioController extends Controller
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
     * Lists all Inventario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InventarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inventario model.
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
     * Creates a new Inventario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inventario();

        if ($model->load(Yii::$app->request->post(), 'Inventario') && $model->save()) 
        {
            return $this->redirect(['view', 'id' => $model->INVE_ID]);
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Inventario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        
        if ($model->load(Yii::$app->request->post(), 'Inventario') && $model->save()) 
        {
            // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            // echo \yii\helpers\Json::encode($model);
            return $this->redirect(['view', 'id' => $model->INVE_ID]);

        } 
        else 
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        
    }

    /**
     * Deletes an existing Inventario model.
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
     * Finds the Inventario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inventario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inventario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function summaryInventory($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
    }
}
