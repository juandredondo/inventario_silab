<?php 
namespace app\components;

use Yii;
use yii\base\Model;

/**
* Clase para facilitar la creacion de datos para servirce como resultado en una peticion Ajax.
* El objectivo es crear un estandar de respuesta para solicitudes como un registro de formulario,
* o el calculo de un procedimiento, indicando si ha sido correcto el proceso u ocurrio un error.
* Ademas, está pensado para usarse con un widget tipo alert en el UI.
* @author Jeancarlo Fontalvo
* @version 1.0
*/
class AjaxResult extends Model {

    const STATUS_OK       = 0;
    const STATUS_BAD      = -1;
    const STATUS_WARNING  = 1;
    const ACTION_REDIRECT = "replace";
    const ACTION_REFRESH  = "reload";

    private $_data        = [];
    private static $formResult = [
        "message" => "",
        "errors"  => [],
        "data"    => [],
        "status"  => self::STATUS_OK,
    ];

    public $addIfNotExists = false;

    public function setData( $value = [] ) 
    {
        $this->_data = $value;
        return $this;
    }

    public function getData() 
    {
        return $this->_data;
    }

    public function asFormResult()
    {
        $this->setData( self::$formResult );
        return $this;
    }

    public function put( $key, $value = null )
    {
        if( isset($key) ) {
            $this->_data[ $key ] = $value;
        }

        return $this;
    }

    public function get( $key, $default = null )
    {
        if( array_key_exists( $key, $this->_data ) ) {
            return $this->_data[ $key ];
        }
        else {
            if( $this->addIfNotExists ) {
                $this->put( $key, $default );
            }
        }

        return $default;
    }

    public static function create($config = [], $asFormResult = true)
    {
        $result = new AjaxResult();

        if( isset( $config[ "data" ] ) ) {
            foreach($config[ "data" ] as $key => $value ) 
            {
                $result->put($key, $value);
            }
        }

        if($asFormResult) {
            $result->asFormResult();
        }

        return $result;
    }

    /*
        Metodos comunes
    */
    public function message($value = null ) {
        if( isset($value) ) {
            $this->put("message", $value);

            return $this;
        }
        else {
            return $this->get( "message" );
        }
    }

    public function status($value = null ) {
        
        if( isset($value) ) {
            $this->put("status", $value);

            return $this;
        }
        else {
            return $this->get( "status" );
        }
    }

    public function action( $type = null, $value = null ) {
        
        if( isset($type) ) {
             $values = [
                "type"  => $type,
                "value" => !isset($value) ? ( $type == self::ACTION_REFRESH ? true : "" ) : $value
            ];
            
            $this->put( "action", AjaxResult::create( [ "data" => $values ], false ));

            return $this;
        }
        else {
            return $this->get("action");
        }

    }

    public function toArray()
    {
        return $this->data;
    }
    
}

?>