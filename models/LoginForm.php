<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Usuario o contraseña incorrectos.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        $isLogged = false;
        $identity = null;

        if ($this->validate()) 
        {
            $identityClass = Yii::$app->user->identityClass;

            $identity = $identityClass::findByUsernameAndPassword($this->username, $this->password);

            if(Yii::$app->user->enableSession)
            {
                $isLogged = Yii::$app->user->login($identity, $this->rememberMe ? 3600 *24*30: 0);
            }
            else if( $identity !== null )
            {
                $isLogged = true;
            }
        }
        return ["logged" => $isLogged, "identity" => $identity ];
    }


    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->password = md5($this->password);
            $this->_user = Usuario::findByUsernameAndPassword($this->username, $this->password);
        }

        return $this->_user;
    }
}
