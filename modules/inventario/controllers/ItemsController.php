<?php

namespace app\modules\inventario\controllers;

use Yii;
use app\modules\inventario\models\core\Items;
use app\modules\inventario\models\core\ItemConsumible;
use app\modules\inventario\models\core\ItemsSearch;
use app\modules\inventario\models\core\TipoItem;

use app\modules\inventario\models\Reactivo;
use app\modules\inventario\models\Material;
use app\modules\inventario\models\Equipo;
use app\modules\inventario\models\Accesorios;
use app\modules\inventario\models\Herramienta;
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
            'item' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Items model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $reactivo       = new Reactivo();
        $itemConsumible = new ItemConsumible();
        $item           = new Items();
        $data           = Yii::$app->request->post();

        if ($item->load($data, 'Items') && $item->save()) {
            
            $this->saveItem($item,  $data);
        } 
        
        $item->TIIT_ID = TipoItem::Reactivo;

        return $this->render('/items/create', [
            'item'  => $item,
            'model' => $reactivo
        ]);
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
        } 
        else 
        {
            return $this->render('update', [
                'item' => $model,
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
        $model      = null;
        $typeId     = Yii::$app->request->get("tipoItemId");
        $itemId     = Yii::$app->request->get("itemId");
        $formId     = Yii::$app->request->get("formId");
        $consumible = "";
        $formView   = "/_form";

        switch($typeId)
        {
            case TipoItem::Material:
                $formView   = "/material" . $formView;
                $model      = $this->loadModel(Material::className(), $itemId);
            break;

            case TipoItem::Equipo:
                $formView   = "/equipo" . $formView;
                $model      = $this->loadModel(Equipo::className(), $itemId);
            break;

            case TipoItem::Accesorio:
                $formView   = "/accesorio" . $formView;
                $model      = $this->loadModel(Accesorio::className(), $itemId);
            break;


            case TipoItem::Herramienta:
                $formView   = "/herramienta" . $formView;
                $model      = new Herramienta();   
            break;

            case TipoItem::Reactivo:
                $formView   = "/reactivo" . $formView;
                $model      = $this->loadModel(Reactivo::className(), $itemId);
            break;
        }

        $consumible = $model::getItemRelation();
        
        return $this->renderAjax( $formView, [
                'model'                     => $model,
                $consumible[ "relation" ]   => new $consumible[ "class" ],
                'submitButton'              => false,
                'formId'                    => $formId,
                'isJustLoad'                => true
            ]);
    }

    private function loadTypeMode($itemId, $type)
    {
        $model  = null;

        switch($type)
        {
            case TipoItem::Material:
                $model      = \app\modules\inventario\models\Material::getByItemId( $itemId );
            break;

            case TipoItem::Equipo:
                $model      = \app\modules\inventario\models\Equipo::getByItemId( $itemId );
            break;

            case TipoItem::Accesorio:
                $model      = \app\modules\inventario\models\Accesorio::getByItemId( $itemId );
            break;


            case TipoItem::Herramienta:
                $model      = \app\modules\inventario\models\Herramienta::getByItemId( $itemId );              
            break;

            case TipoItem::Reactivo:
                $model      = \app\modules\inventario\models\Reactivo::getByItemId( $itemId );
            break;
        }
        
        return $model;
    }

    protected function loadModel($class, $id)
    {
        $model = null;

        if($id !== null && $id !== "")
            $model = $class::findOne($id);
        else
            $model = new $class;

        return $model;
    } 

    /**
    * @param $item El item (instancia de Items) que servira de base para guardar los subitems
    * @param $data La informacion cargada, ya sea por un array asociativo con el nombre del modelo
    */
    private function saveItem($item, $data)
    {
        $model  = null;

        switch($item->tipoItemId)
        {
            case TipoItem::Material:
                $model      = \app\modules\inventario\models\Material::getByItemId( $itemId );
            break;

            case TipoItem::Equipo:
                $model      = \app\modules\inventario\models\Equipo::getByItemId( $itemId );
            break;

            case TipoItem::Accesorio:
                $model      = \app\modules\inventario\models\Accesorio::getByItemId( $itemId );
            break;


            case TipoItem::Herramienta:
                $model      = \app\modules\inventario\models\Herramienta::getByItemId( $itemId );              
            break;

            case TipoItem::Reactivo:
                $model      = \app\modules\inventario\models\Reactivo::getByItemId( $itemId );
            break;
        }
        
        return $model;
    }
}
