<?php 

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

use app\modules\admin\models\PerfilRole;
use app\modules\admin\models\PerfilRoleSearch;
use app\modules\admin\models\PermisoSearch;
use app\modules\admin\models\RolSearch;


class ManagerController extends Controller
{
    public function actionIndex()
    {
        $rol                = new RolSearch();
        $rolProvider        = $rol->search(Yii::$app->request->queryParams);

        $perfilRole         = new PerfilRoleSearch();
        $perfilRoleProvider = $perfilRole->search(Yii::$app->request->queryParams);

        $permiso            = new PermisoSearch();
        $permisoProvider    = $permiso->search(Yii::$app->request->queryParams);

        

        $models = [
            'rol'       => [
                'searchModel'   => $rol,
                'dataProvider'  => $rolProvider,
            ],
            'perfil'    => [
                'searchModel'   => $perfilRole,
                'dataProvider'  => $perfilRoleProvider,
            ],
            'permiso'   => [
                'searchModel'   => $permiso,
                'dataProvider'  => $permisoProvider,
            ]
        ];

        return $this->render('index', [
            'models' => $models
        ]);
    }

    public function beforeAction($action)
    {
        if ($action->id != 'index') {
            $this->redirect(['index']);
            return false;
        }

        return true;
    }

    public function actionRedirect()
    {
        $this->redirect(['index']);
    }
}
?>