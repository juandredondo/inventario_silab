<?php

namespace app\modules\inventario\controllers;

use Yii;
use app\modules\inventario\models\Accesorios;
use app\modules\inventario\models\AccesoriosSearch;
use app\components\core\controllers\BaseItemController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccesoriosController implements the CRUD actions for Accesorios model.
 */
class AccesoriosController extends BaseItemController
{
    public $modelClass = "app\modules\inventario\models\Accesorios";
    public $viewName   = "accesorio";
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
     * Lists all Accesorios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel    = new AccesoriosSearch();
        $dataProvider   = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
        ]);
    }

    /**
     * Displays a single Accesorios model.
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
     * Creates a new Accesorios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $accesorio  = new Accesorios();
        $data       = Yii::$app->request->post();

        if($data != null && 
                $accesorio->item->load($data, 'Items') &&
                    $accesorio->parent->load($data, 'ItemNoConsumible') &&
                        $accesorio->load($data, 'Accesorios')
          )
        {            
            if($accesorio->validate())
            {              
                $accesorio->save();
                return $this->redirect(['view', 'id' => $accesorio->item->id]);
            }
        }
        
        return $this->render('/accesorios/create', [
                'model'          => $accesorio
            ]);
    }

    /**
     * Updates an existing Accesorios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $accesorio  = $this->findModel($id);
        $data       = Yii::$app->request->post();

        if($data != null && 
                $accesorio->item->load($data, 'Items') &&
                    $accesorio->parent->load($data, 'ItemNoConsumible') &&
                        $accesorio->load($data, 'Accesorios')
          )
        {            
            if($accesorio->validate())
            {              
                $accesorio->save();
                return $this->redirect(['view', 'id' => $accesorio->item->id]);
            }
        }
        
        return $this->render('/material/update', [
            //'item'           => $accesorio->item,
            //'itemConsumible' => $accesorio->parent,
            'model'          => $accesorio
        ]);
    }

    /**
     * Deletes an existing Accesorios model.
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
     * Finds the Accesorios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Accesorios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Accesorios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
