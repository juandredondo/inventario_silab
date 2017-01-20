<?php

namespace app\modules\inventario\controllers;

use Yii;
use app\modules\inventario\models\Herramienta;
use app\modules\inventario\models\HerramientaSearch;
use app\components\core\controllers\BaseItemController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HerramientaController implements the CRUD actions for Herramienta model.
 */
class HerramientaController extends BaseItemController
{
    public $modelClass = "app\modules\inventario\models\Herramienta";
    public $viewName   = "herramienta";
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
     * Lists all Herramienta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HerramientaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Herramienta model.
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
     * Creates a new Herramienta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $herramienta    = new Herramienta();
        $data           = Yii::$app->request->post();

        if($data != null && 
                $herramienta->item->load($data, 'Items') &&
                    $herramienta->parent->load($data, 'ItemNoConsumible') &&
                        $herramienta->load($data, 'Herramienta')
          )
        {            
            if($herramienta->validate())
            {              
                $herramienta->save();
                return $this->redirect(['view', 'id' => $herramienta->item->id]);
            }
        }
        
        return $this->render('/herramienta/create', [
                'model'          => $herramienta
            ]);
    }

    /**
     * Updates an existing Herramienta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $herramienta    = $this->findModel($id);
        $data           = Yii::$app->request->post();

        if($data != null && 
                $herramienta->item->load($data, 'Items') &&
                    $herramienta->parent->load($data, 'ItemNoConsumible') &&
                        $herramienta->load($data, 'Herramienta')
          )
        {            
            if($herramienta->validate())
            {              
                $herramienta->save();
                return $this->redirect(['view', 'id' => $herramienta->item->id]);
            }
        }
        
        return $this->render('/herramienta/update', [
            //'item'           => $herramienta->item,
            //'itemConsumible' => $herramienta->parent,
            'model'          => $herramienta
        ]);
    }

    /**
     * Deletes an existing Herramienta model.
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
     * Finds the Herramienta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Herramienta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Herramienta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
