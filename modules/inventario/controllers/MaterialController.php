<?php

namespace app\modules\inventario\controllers;

use Yii;
use app\modules\inventario\models\Material;
use app\modules\inventario\models\MaterialSearch;
use app\components\core\controllers\BaseItemController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MaterialController implements the CRUD actions for Material model.
 */
class MaterialController extends BaseItemController
{
    public $modelClass = "app\modules\inventario\models\Material";
    public $viewName   = "material";
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
     * Lists all Material models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaterialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Material model.
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
     * Creates a new Material model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {        
        $material   = new \app\modules\inventario\models\Material();
        $data       = Yii::$app->request->post();

        if($data != null && 
                $material->item->load($data, 'Items') &&
                    $material->parent->load($data, 'ItemConsumible') &&
                        $material->load($data, 'Material')
          )
        {            
            
            if($material->validate())
            {              
                $material->save();
                return $this->redirect(['view', 'id' => $material->item->id]);
            }
        }
        
        return $this->render('/material/create', [
                'model'          => $material
            ]);
    }

    /**
     * Updates an existing Material model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $material       = $this->findModel($id);
        //$material->fillParents();
        $data       = Yii::$app->request->post();

        if($data != null && 
                $material->item->load($data, 'Items') &&
                    $material->parent->load($data, 'ItemConsumible') &&
                        $material->load($data, 'Material')
        )
        {            
            if($material->validate())
            {              
                $material->save();
                return $this->redirect(['view', 'id' => $material->item->id]);
            }
        }
        
        return $this->render('/material/update', [
            //'item'           => $material->item,
            //'itemConsumible' => $material->parent,
            'model'          => $material
        ]);
    }

    /**
     * Deletes an existing Material model.
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
     * Finds the Material model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Material the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Material::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
