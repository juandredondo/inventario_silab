<?php

namespace app\controllers;

use Yii;
use app\models\Funcionario;
use app\models\Persona;
use app\models\FuncionarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FuncionarioController implements the CRUD actions for Funcionario model.
 */
class FuncionarioController extends Controller
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
     * Lists all Funcionario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FuncionarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Funcionario model.
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
     * Creates a new Funcionario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $funcionario = new Funcionario();
        $persona = new Persona();

        if ($persona->load(Yii::$app->request->post()) ) {

             if($persona->save()){
                $funcionario->PERS_ID = $persona->PERS_ID; 

                if($funcionario->save())
                     return $this->redirect(['view', 'id' => $funcionario->FUNC_ID]);
            }
           
           
        } else {
            return $this->render('create', [
                'funcionario' => $funcionario,
                'persona' => $persona,
            ]);
        }
    }

    /**
     * Updates an existing Funcionario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $funcionario = $this->findModel($id);
        $persona     = Persona::findOne($funcionario->PERS_ID);

        if ($persona->load(Yii::$app->request->post()) ) {
            if($persona->save()){
                $funcionario->PERS_ID = $persona->PERS_ID; 

                if($funcionario->save())
                     return $this->redirect(['view', 'id' => $funcionario->FUNC_ID]);
            }
           
           
        } else {
            return $this->render('update', [
                'funcionario' => $funcionario,
                'persona' => $persona,
            ]);
        }
    }

    /**
     * Deletes an existing Funcionario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        Persona::findOne($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Funcionario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Funcionario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Funcionario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
