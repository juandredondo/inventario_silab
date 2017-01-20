<?php

namespace app\modules\inventario\controllers;

use Yii;
use app\modules\inventario\models\Equipo;
use app\modules\inventario\models\EquipoSearch;
use app\components\core\controllers\BaseItemController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EquipoController implements the CRUD actions for Equipo model.
 */
class EquipoController extends BaseItemController
{
    public $modelClass = "app\modules\inventario\models\Equipo";
    public $viewName   = "equipo";
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
     * Lists all Equipo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EquipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Equipo model.
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
     * Creates a new Equipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $equipo   = new Equipo();
        $data     = Yii::$app->request->post();

        if($data != null && 
                $equipo->item->load($data, 'Items') &&
                    $equipo->parent->load($data, 'ItemNoConsumible') &&
                        $equipo->load($data, 'Equipo')
          )
        {            
            
            if($equipo->validate())
            {              
                $equipo->save();
                return $this->redirect(['view', 'id' => $equipo->item->id]);
            }
        }
        
        return $this->render('/equipo/create', [
                'model'          => $equipo
            ]);
    }

    /**
     * Updates an existing Equipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $equipo = $this->findModel($id);

        $data     = Yii::$app->request->post();

        if($data != null && 
                $equipo->item->load($data, 'Items') &&
                    $equipo->parent->load($data, 'ItemNoConsumible') &&
                        $equipo->load($data, 'Equipo')
          )
        {            
            
            if($equipo->validate())
            {              
                $equipo->save();
                return $this->redirect(['view', 'id' => $equipo->item->id]);
            }
        }
        
        return $this->render('/equipo/update', [
            'model'          => $equipo
        ]);
    }

    /**
     * Deletes an existing Equipo model.
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
     * Finds the Equipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Equipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Equipo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
