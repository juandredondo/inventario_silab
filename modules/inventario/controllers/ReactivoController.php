<?php

namespace app\modules\inventario\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

use app\config\SilabConfig;
use app\modules\inventario\controllers\core\BaseItemController;

use app\modules\inventario\models\core\Items;
use app\modules\inventario\models\core\ItemConsumible;
use app\modules\inventario\models\core\TipoItem;
use app\modules\inventario\models\core\EstadoConsumible;
use app\modules\inventario\models\Caducidad;
use app\modules\inventario\models\Reactivo;
use app\modules\inventario\models\ReactivoSearch;

/**
 * ReactivoController implements the CRUD actions for Reactivo model.
 */
class ReactivoController extends BaseItemController
{
    public $modelClass = "app\modules\inventario\models\Reactivo";
    public $viewName   = "reactivo";
    

    /**
     * Lists all Reactivo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReactivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reactivo model.
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
     * Deletes an existing Reactivo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
