<?php 
namespace app\components\filters;

use Yii;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\UnauthorizedHttpException;

class AuthCookieFilter extends AccessControl  
{
    
    public $ruleConfig = ['class' => 'app\components\filters\AuthAccessRule'];
    /**
     * @var array a list of access rule objects or configuration arrays for creating the rule objects.
     * If a rule is specified via a configuration array, it will be merged with [[ruleConfig]] first
     * before it is used for creating the rule object.
     * @see ruleConfig
     */
    public $rules = [];

    /*
    public function behaviors()
    {
        return [
            'authenticator' => [
                'class' => \yii\filters\auth\HttpBasicAuth::className(),
            ]
        ];
    }
    */

    /**
     * This method is invoked right before an action is to be executed (after all possible filters.)
     * You may override this method to do last-minute preparation for the action.
     * @param Action $action the action to be executed.
     * @return bool whether the action should continue to be executed.
     */
    public function beforeAction($action)
    {
        $user               = $this->user;
        $request            = Yii::$app->getRequest();
        $response           = Yii::$app->getResponse();
        //$user->identity     = $this->authenticate($user, $request, $response);

         /* @var $rule AccessRule */
        foreach ($this->rules as $rule) 
        {
            if ($allow = $rule->allows($action, $user, $request)) 
            {
                return true;
            } 
            elseif ($allow === false) 
            {
                if (isset($rule->denyCallback)) 
                {
                    call_user_func($rule->denyCallback, $rule, $action);
                } 
                elseif ($this->denyCallback !== null) 
                {
                    call_user_func($this->denyCallback, $rule, $action);
                } 
                else 
                {
                    $this->denyAccess($user);
                }

                return false;
            }
        }

        if ($this->denyCallback !== null) 
        {
            call_user_func($this->denyCallback, null, $action);
        } 
        else 
        {
            $this->denyAccess($user);
        }

        return false;
    }

    /**
     * Denies the access of the user.
     * The default implementation will redirect the user to the login page if he is a guest;
     * if the user is already logged, a 403 HTTP exception will be thrown.
     * @param User $user the current user
     * @throws ForbiddenHttpException if the user is already logged in.
     */
    protected function denyAccess($user)
    {
        if ($user->getIsGuest()) {
            $user->loginRequired();
        } else {
            throw new ForbiddenHttpException(Yii::t('yii', 'No estas autorizado para acceder a esta seccion.'));
        }
    }
}

?>