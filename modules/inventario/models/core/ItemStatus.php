<?php 
    
namespace app\modules\inventario\models\core;

use Yii;

/**
 * Representa un status de informacion, sobre el guardado o actualizado de un item y sus derivados
 * Esta clase es usada por la clase, "ItemBase" para informar sobre el proceso de guardado en cadena
 * @author Jeancarlo Fontalvo, Jaider Kaleb
 * @since 1.1
 */
class ItemStatus extends \yii\base\Object
{
    private $_logs;
    private $_currentState;
    
    public function init()
    {
        $this->logs  = [];
        $this->state = false;
    }

    public function getLogs() {
        return $this->_logs;
    }
    public function setLogs($value = []) {
         $this->_logs = $value;
    }

    public function getState() {
        return $this->_currentState;
    }
    public function setState($value = false) {
         $this->_currentState = $value;
    }

    public function put($log, $key = "")
    {
        $isArray = gettype($log) == "array";
        $key     = ( $isArray )? ( ($key == "") ?  array_shift( array_keys($log) ) : $key  )  : null;
        
        if($isArray && $key != null)
		{
			$this->logs[ $key ] = isset( $this->logs[ $key ] ) ? $this->logs[ $key ] : [];
		    array_push($this->logs[ $key ], $log);
		}
        else
            array_push($this->logs, $log);
    }

    public function putWithKey($key, $log)
    {
        $this->logs[ $key ] = isset( $this->logs[ $key ] ) ? $this->logs[ $key ] : [];
        array_push($this->logs[ $key ], $log);
    }
    public function get($key)
    {
        return $this->logs[ $key ];
    }
	
	public function show()
	{
		echo json_encode($this->logs);
	}
}



?>