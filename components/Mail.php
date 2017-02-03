<?php 
namespace app\components;

use Yii;
use yii\base\Object;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* Mail helper para enviar mensajes predefinidos a usuarios
* @author Jeancarlo Fontalvo */
class Mail 
{
    protected function notify($userEmail, $subject)
    {
        Yii::$app->mailer->compose()
                ->setTo($userEmail)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
        return false;
    }
}

?>