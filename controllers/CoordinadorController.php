<?php

namespace app\controllers;

use Yii;
use app\models\Coordinador;
use app\models\Persona;
use app\models\CoordinadorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Usuario;
use app\modules\admin\models\Rol;


/**
 * CoordinadorController implements the CRUD actions for Coordinador model.
 */
class CoordinadorController extends Controller
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
     * Lists all Coordinador models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CoordinadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Coordinador model.
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
     * Creates a new Coordinador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $coordinador = new Coordinador();
        $persona     = new Persona();

        if ($persona->load(Yii::$app->request->post()) ) {
            if($persona->save()){
                $coordinador->PERS_ID = $persona->PERS_ID; 

            $username = substr(str_replace(' ','',strtolower($persona->PERS_NOMBRE)), 0, 5) . rand(1,20);
            $usuario = new Usuario( [ 
               "PERS_ID" => $persona->PERS_ID,
               "ROL_ID"  => Rol::getRoleByName(  Rol::Coordinador )->ROL_ID,
               "USUA_PASSWORD" => md5( 123456 ),
               "USUA_ES_ACTIVO"=>1,
               "USUA_TOKEN"=>md5($persona->PERS_ID),
               "USUA_USUARIO" => $username
              ]);
                $usuario->save();
                if($coordinador->save())
                     return $this->redirect(['view', 'id' => $coordinador->COOR_ID]);
            }
           
        } else {
            return $this->render('create', [
                'coordinador' => $coordinador,
                'persona' => $persona,
            ]);
        }
    }

    /**
     * Updates an existing Coordinador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $coordinador = $this->findModel($id);
        $persona = Persona::findOne($coordinador->PERS_ID);
            if ($persona->load(Yii::$app->request->post()) ) {
                        if($persona->save()){
                            $coordinador->PERS_ID = $persona->PERS_ID; 

                            if($coordinador->save())
                                 return $this->redirect(['view', 'id' => $coordinador->COOR_ID]);
                        }
                       
                    } else {
                        return $this->render('update', [
                            'coordinador' => $coordinador,
                            'persona' => $persona,
                        ]);
                    }
    }

    /**
     * Deletes an existing Coordinador model.
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
     * Finds the Coordinador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Coordinador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Coordinador::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
