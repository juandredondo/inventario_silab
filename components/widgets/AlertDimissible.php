<?php 

namespace app\components\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\helpers\AlertHelper;

/**
* Renderiza un alert, en funcion del Flash recurrente de alerta
* @author Jeancarlo M. Fontalvo 
* @since 1.1
*/
class AlertDimissible extends Widget
{
    const TYPE_SUCCESS  = "success";
    const TYPE_INFO     = "info";
    const TYPE_WARNING  = "warning";
    const TYPE_DANGER   = "danger";
    const TYPE_DEFAULT  = "default";
    
    private static $templatePath = "@app/views/templates/_php";
    private static $_session     = null;


    public static function getSession()
    {
        if(static::$_session == null)
        {
            static::$_session = Yii::$app->session;
        }

        return static::$_session;
    }

    public static $defaultFlashKey = AlertHelper::DEFAULT_KEY;

    public $key     = null;

    public $type    = self::TYPE_SUCCESS;
    public $icon    = [ "class" => 'icon icon-bottom material-icons', "text" => "" ];
    public $title   = AlertHelper::DEFAULT_TITLE;
    public $content = "";


    public function init()
    {
        if($this->key === null || $this->key === "")
            $this->key = static::$defaultFlashKey;

        if( $this->checkFlash($this->key) )
        {
            $alertData = $this->getFlash();

            $this->title            = $alertData[ "title" ];
            $this->content          = $alertData[ "message" ];
            $this->type             = $alertData[ "type" ];
            $this->icon[ "text" ]   = $alertData[ "icon" ][ "text" ];
        }
        else
        {
            // 2. Init promp
            if($this->content === null)
                $this->content = "";

            if($this->title === null)
                $this->title = "";
            
            if($this->type === null)
            {
                $this->type = self::TYPE_SUCCESS;
            }
        }
        
        // 1. Llamada al iniciador pariente
        parent::init();
    }

    public function run()
    {
        if($this->content !== "")
        {
            $template = $this->render("@app/views/templates/_php/_alert-dimissible.php", [ 
                        "type" => $this->type,
                        "icon" => $this->icon,
                        "title" => $this->title,
                        "content" => $this->content
                    ]);

            return $template;
        }

        return "";
    }

    private function checkFlash($key)
    {
        return static::getSession()->hasFlash( $key );
    }

    private function getFlash($key = null)
    {
        return static::getSession()->getFlash( isset($key) ? $key : $this->key );
    }
}

?>