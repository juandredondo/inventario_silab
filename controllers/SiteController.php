<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use \yii\helpers;

use app\models\ContactForm;
use app\components\JsonHelper;
use app\components\filters\AuthCookieFilter;
// Admin module models
use app\modules\admin\models\LoginForm;
use app\modules\admin\models\Rol;
use app\models\Test;
use app\components\Notification;
use app\modules\inventario\models\core\TipoItem;
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AuthCookieFilter::className(),
                'only'  => ['logout', 'hola'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [ "hola" ],
                        'allow' => true,
                        'roles' => [ Rol::Coordinador ]
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    //'test'   => ['post']
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }

        $model = new LoginForm();
        
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionAuthenticate($url = 'dashboard')
    {
        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post())) 
        {
            $login = $model->login();
            if($login[ "logged" ])
                return $this->redirect(['site/index']);
        } 

        return $this->redirect(['site/login']);
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('login');
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionGetSession()
    {
        return json_encode(Yii::$app->user->isGuest);
    }

    public function actionHola()
    {
        return "Hola";
    }


    public function actionTest()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        /*
        $test  = new TestA;
        $test->load(Yii::$app->request->post(), '');
        $test->save();
        
        return $test;
        
        return [
            \app\modules\inventario\models\Reactivo::getByItemId( 3 ),
            \app\modules\inventario\models\Equipo::getByItemId( 1 ),
        ];*/
        /*
        $array = [
            "MARCA_ID",
            "ITEM_ID",
            "ITEM_NOMBRE",
            "ITEM_OBSERVCION",
            "TIIT_ID"
        ];

        return \app\components\ArrayHelperFilter::merge(
            \app\components\ArrayHelperFilter::remove($array, ["hellos"]),
            [
                [
                    "attr" => "MARC_ID",
                    "value" => "value of MARC_ID"
                ],
                [
                    "attr" => "TIIT_ID",
                    "value" => "value of TIIT_ID"
                ]
            ]
        );   
        */
        return \app\modules\inventario\models\core\Items::findOne(20)->isExpirable;
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionPostNotification()
    {
        $app  = Yii::$app;
        $data = $app->request->getBodyParams();

        if(!empty($data)) {
            Notification::warning(Notification::KEY_EMPTY_ITEMS, 
                    $data[ "user-id" ], 
                    $data[ "inventory-id" ]
            );
        }
    }

    public function actionControllerActions()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $controllers = helpers\FileHelper::findFiles(Yii::getAlias('@inventario/controllers'), ['recursive' => true]);
        $actions = [];
        foreach ($controllers as $controller) {
            $contents = file_get_contents($controller);
            $controllerId = helpers\Inflector::camel2id(substr(basename($controller), 0, -14));
            preg_match_all('/public function action(\w+?)\(/', $contents, $result);
            foreach ($result[1] as $action) {
                $actionId = helpers\Inflector::camel2id($action);
                $route = $controllerId . '/' . $actionId;
                $actions[$route] = $route;
            }
        }
        asort($actions);
        return $actions;
    }

    
}
