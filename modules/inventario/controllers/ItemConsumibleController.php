<?php

namespace app\modules\inventario\controllers;

use Yii;
use app\modules\inventario\models\core\ItemConsumible;
use app\modules\inventario\models\ItemConsumibleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;
use app\modules\inventario\models\core\Items;
use app\modules\inventario\models\core\EstadoConsumible;
use yii\helpers\ArrayHelper;

/**
 * ItemConsumibleController implements the CRUD actions for ItemConsumible model.
 */
class ItemConsumibleController extends Controller
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
     * Lists all ItemConsumible models.
     * @return mixed
     */

    public function actionEstados()
    {
        return $this->render('/items/formestados');
    }
    public function actionRptestadoitems(){
        $mpdf=new mPDF();
        $estado = $_REQUEST["ESCO_ID"];
        $model = ItemConsumible::find()
        ->where(['ESCO_ID'=>$estado])->all();

         $mpdf->useOnlyCoreFonts = true;
         $mpdf->SetTitle("ESTADO DE LOS ITEMS");
         $mpdf->SetAuthor("SILAB ");
         $mpdf->SetWatermarkText("SILAB ");
         $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($this->renderPartial('itemagotado', [
                        'model' => $model,
                ],true));

        $mpdf->Output();
       
        return $this->renderPartial('itemagotado');
    }
    public function actionIndex()
    {
        $searchModel = new ItemConsumibleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemConsumible model.
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
     * Creates a new ItemConsumible model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemConsumible();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ITCO_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ItemConsumible model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ITCO_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ItemConsumible model.
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
     * Finds the ItemConsumible model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemConsumible the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemConsumible::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
