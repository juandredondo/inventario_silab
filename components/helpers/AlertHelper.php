<?php 

namespace app\components\helpers;

use Yii;
use yii\base\Object;

/**
* Provee una abstraccion para crear alertas a las vistas, las vistas que tengan acceso al 
* flash de la session, podran desplegar la alerta
* @author Jeancarlo Fontalvo
* @since 1.0
*/
class AlertHelper extends Object
{
    const SUCCESS_TITLE = "ENHORABUENA";
    const INFO_TITLE    = "INFORMACION";
    const WARNING_TITLE = "ADVERTENCIA";
    const DANGER_TITLE  = "PELIGRO";
    const ERROR_TITLE   = "OOPS";
    const DEFAULT_TITLE = "ALERTA";

    const TYPE_SUCCESS  = "success";
    const TYPE_INFO     = "info";
    const TYPE_WARNING  = "warning";
    const TYPE_DANGER   = "danger";
    const TYPE_DEFAULT  = "default";

    const ICON_SUCCESS  = "check_circle";
    const ICON_INFO     = "info";
    const ICON_ERROR    = "error";
    const ICON_WARNING  = "warning";
    const ICON_CLOCK    = "schedule";
    
    private static $_session    = null;
    private static $_view       = null;

    const DEFAULT_KEY = "alert-flash";

    public static function getView()
    {
        if(static::$_view == null)
        {
            static::$_view = Yii::$app->view;
        }

        return static::$_view;
    }

    public static function getSession()
    {
        if(static::$_session == null)
        {
            static::$_session = Yii::$app->session;
        }

        return static::$_session;
    }  

    public static function success($message, $key = null, $title = self::SUCCESS_TITLE, $data = [])
    {
        $tools = static::getTools();

        $tools[ "session" ]->setFlash(isset($key) ? $key : self::DEFAULT_KEY, static::alertArray(
            $title, $message, self::TYPE_SUCCESS, self::ICON_SUCCESS
        ));
    }

    public static function danger($message, $key = null, $title = self::DANGER_TITLE, $data = [])
    {
        $tools = static::getTools();

        $tools[ "session" ]->setFlash(isset($key) ? $key : self::DEFAULT_KEY, static::alertArray(
            $title, $message, self::TYPE_DANGER, self::ICON_WARNING
        ));
    }

    public static function warning($message, $key = null, $title = self::WARNING_TITLE, $data = [])
    {
        $tools = static::getTools();

        $tools[ "session" ]->setFlash(isset($key) ? $key : self::DEFAULT_KEY, static::alertArray(
            $title, $message, self::TYPE_WARNING, self::ICON_WARNING
        )); 
    }

    public static function info($message, $key = null, $title = self::INFO_TITLE, $data = [])
    {
        $tools = static::getTools();

        $tools[ "session" ]->setFlash(isset($key) ? $key : self::DEFAULT_KEY, static::alertArray(
            $title, $message, self::TYPE_INFO, self::ICON_INFO
        )); 
    }

    public static function error($message, $key = null, $title = self::ERROR_TITLE, $data = [])
    {
        $tools = static::getTools();

        $tools[ "session" ]->setFlash(isset($key) ? $key : self::DEFAULT_KEY, static::alertArray(
            $title, $message, self::TYPE_DANGER, self::ICON_ERROR
        )); 
    }

    private static function getTools()
    {
        return [
            "session"   => static::getSession(),
            "view"      => static::getView()
        ];
    }

    public static function alertArray($title, $message, $type = self::TYPE_DEFAULT, $icon = self::ICON_INFO, $extraData = [])
    {
        return [
            "title"     => $title,
            "type"      => $type,
            "message"   => $message,
            "icon"      => [
                "text"  => $icon
            ],
            "data"      => $extraData
        ];
    }
}

?>