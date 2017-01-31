<?php

namespace app\controllers;

use Yii;
use app\models\Laboratorio;
use app\models\LaboratorioConfig;
use app\models\LaboratorioSearch;
use app\models\FuncionarioLaboratorio;
use app\models\FuncionarioLaboratorioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LaboratorioController implements the CRUD actions for Laboratorio model.
 */
class LaboratorioController extends Controller
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
                    'delete'             => ['POST'],
                    'get-inventarios'    => ['GET']
                ],
            ],
        ];
    }

    /**
     * Lists all Laboratorio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LaboratorioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Laboratorio model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $searchModel = new FuncionarioLaboratorioSearch();
        // manda a buscar todos los funconarios que pertenezcan a un laboratorio en especifico
        $dataProvider = $searchModel->search2($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
             'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Laboratorio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        //1. delclaran objetos de cada uno de los modelos 
        $modelLaboratorio = new Laboratorio();
        $modelLabFuncionario= new FuncionarioLaboratorio;

        //2.se  valida de que si e modelo del laboratorio esta cargado
        if ($modelLaboratorio->load(Yii::$app->request->post())) 
        {
            //2.1 guarda los  datos del laboratorio en la base de datos    
            $modelLaboratorio->save();

            return $this->redirect(['funcionario-laboratorio/create', 'idLaboratorio' => $modelLaboratorio->LABO_ID]);
        } else {
            return $this->render('create', [
                'model' => $modelLaboratorio,
            ]);
        }
    }

    /**
     * Updates an existing Laboratorio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->LABO_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Laboratorio model.
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
     * Finds the Laboratorio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Laboratorio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Laboratorio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Laboratorio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $nombre
     * @return Laboratorio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findByNombre($nombre)
    {
        if (($model = Laboratorio::getByNombre($alias)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Laboratorio model based on its id or name alias
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $nombre
     * @return Laboratorio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findByIdOrName($id = 0, $alias = "")
    {
        $laboratory = null;

        if($id > 0)
        {
            $laboratory  = $this->findModel($id);
        }
        // 2.1 Buscar por Alias o nombre
        else if($alias !== "")
        {
            $laboratory  = $this->findByNombre(str_replace('-', ' ', $alias));
        }

        return $laboratory;
    }


    /**
    * Busca los inventarios asociados al laboratorio
    * @param entero $id laboratorio id 
    * @return mixed
    * @throws NotFoundHttpException si no se encuentra el laboratorio
    */
    public function actionGetInventarios($id = 0, $alias = "")
    {
        // 1. local variables
        $return = [ 'laboratory' => null, 'inventories'  =>  [] ];
        // 2. Buscar por Id
        if($id > 0)
        {
            $return[ 'laboratory' ]  = $this->findModel($id);
        }
        // 2.1 Buscar por Alias o nombre
        else if($alias !== "")
        {
            $return[ 'laboratory' ]  = $this->findByNombre(str_replace('-', ' ', $alias));
        }
        // 3. Buscar inventarios
        $return[ 'inventories' ] = Laboratorio::getInventariosById($return[ 'laboratory' ]->id);

        return $this->render('inventories', [
            'data'          => $return,
        ]);

        return $return;
    }

    /**
    *   Manager para el laborotario especifco del alias provisto
    *   @param string alias nombre del laboratorio
    *   @return mixed
    *   @throws NotFoundHttpException si no se encuentra el laboratorio
    */
    public function actionManager($id = 0, $alias = "")
    {
        $return             = [ 
            'laboratory'    => null, 
            'inventories'   => [],
            'functioners'   => [],
            'extraData'     => [] 
        ];
        // 1. get the laboratory 
        $return[ 'laboratory' ]     = $this->findByIdOrName($id, $alias);
        $return[ 'inventories' ]    = $return[ 'laboratory' ]->inventarios;
        $return[ 'functioners' ]    = $return[ 'laboratory' ]->funcionarios;
        $return[ 'config' ]         = $return[ 'laboratory' ]->currentConfig;
        return $this->render("manager", [
                'data' => $return
            ]
        );
    }

    public function actionGetAll($page = 10)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return Laboratorio::find()->limit($page)->orderBy("LABO_NOMBRE")->all();
    }

    public function actionAddConfig()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $config = new LaboratorioConfig();
        $data   = Yii::$app->request->post();

        if( $config->load( $data ) && $config->save())
        {
            return [
                "message" => "Configuracion guardada",
                "status"  => 0
            ];
        }
        else
        {
            return [
                "message" => "Oops no se pudo guardar la configuracion",
                "status"  => -1
            ];
        }
    }
    
}


