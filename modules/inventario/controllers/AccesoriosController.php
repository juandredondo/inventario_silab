<?php

namespace app\modules\inventario\controllers;

use Yii;
use app\modules\inventario\models\Accesorios;
use app\modules\inventario\models\AccesoriosSearch;
use app\modules\inventario\controllers\core\BaseItemController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccesoriosController implements the CRUD actions for Accesorios model.
 */
class AccesoriosController extends BaseItemController
{
    public $modelClass = "app\modules\inventario\models\Accesorios";
    public $viewName   = "accesorios";
    

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
