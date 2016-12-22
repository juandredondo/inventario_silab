<?php

namespace app\modules\inventario\controllers;

use Yii;
use app\modules\inventario\models\Items;
use app\modules\inventario\models\Reactivo;
use app\modules\inventario\models\Material;
use app\modules\inventario\models\Equipo;
use app\modules\inventario\models\Accesorios;
use app\modules\inventario\models\Herramienta;
use app\modules\inventario\models\TipoItem;
use app\modules\inventario\models\ItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemsController implements the CRUD actions for Items model.
 */
class ItemsController extends Controller
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
                    'load-form' => ['GET']
                ],
            ],
        ];
    }

    /**
     * Lists all Items models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Items model.
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
     * Creates a new Items model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Items();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ITEM_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Items model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ITEM_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Items model.
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
     * Finds the Items model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Items the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Items::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLoadForm()
    {
        $model  = null;
        $typeID = Yii::$app->request->get("tipoItemId");

        $formView   = "/create";

        switch($typeID)
        {
            case TipoItem::Material:
                $formView   = "/material" . $formView;
                $model      = new Material();
            break;

            case TipoItem::Equipo:
                $formView   = "/equipo" . $formView;
                $model      = new Equipo();
            break;

            case TipoItem::Accesorio:
                $formView   = "/accesorio" . $formView;
                $model      = new Accesorio();
            break;

            case TipoItem::Herramienta:
                $formView = "/herramienta" . $formView;
                $model      = new Herramienta();                
            break;

            case TipoItem::Reactivo:
                $formView   = "/reactivo" . $formView;
                $model      = new Reactivo();  
            break;
        }

        return $this->renderPartial( $formView,[
                'model' => $model,
            ]
        );
    }
}
