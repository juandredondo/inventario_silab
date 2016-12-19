<?php

namespace app\controllers;

use Yii;
use app\models\FuncionarioLaboratorio;
use app\models\FuncionarioLaboratorioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FuncionarioLaboratorioController implements the CRUD actions for FuncionarioLaboratorio model.
 */
class FuncionarioLaboratorioController extends Controller
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
     * Lists all FuncionarioLaboratorio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FuncionarioLaboratorioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FuncionarioLaboratorio model.
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
     * Creates a new FuncionarioLaboratorio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //1. delcaracion de los objetos de las diferentes clases de los modelos 
        $modelFuncioLab = new FuncionarioLaboratorio();
        $searchModel = new FuncionarioLaboratorioSearch();

        //1.1 se captura el idLaboratorio que viene por get
        $idLaboratorio=Yii::$app->request->get('idLaboratorio');

        // manda a buscar todos los funconarios que pertenezcan a un laboratorio en especifico
        $dataProvider = $searchModel->search2($idLaboratorio);

        //2. se valida de que los datos del modelo se hallan cargado
        if ($modelFuncioLab->load(Yii::$app->request->post())){
            //2.1 se le asigna el laboratorio que viene por get
             $modelFuncioLab->LABO_ID=$idLaboratorio;   
             //2.2 se guardan los datos 
             $modelFuncioLab->save();    
            return $this->redirect(['create', 'idLaboratorio' => $idLaboratorio]);
        } else {
            return $this->render('create', [
                'model' => $modelFuncioLab,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Updates an existing FuncionarioLaboratorio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->FULA_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FuncionarioLaboratorio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        

       // return $this->redirect(['index']);
    }

    /**
     * Finds the FuncionarioLaboratorio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FuncionarioLaboratorio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FuncionarioLaboratorio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
