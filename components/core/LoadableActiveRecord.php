<?php 
    
namespace app\components\core;

use app\components\core\IsLoadableInterface;
/**
* Nos permite implementar la interfaz IsLoadableInterface, para indicar si un objeto se ha 
* cargado en una relacion, y asi implementar una especie de singlenton
* @author Jeancarlo Fontalvo
**/
abstract class LoadableActiveRecord extends \yii\db\ActiveRecord implements IsLoadableInterface
{
    public $isLoaded = false;

    public function getIsLoaded() 
    { 
        return $this->isLoaded; 
    }
    
    public function setIsLoaded($value) 
    { 
        $this->isLoaded = $value; 
    }

    public function resetLoad()
    {
        $this->isLoaded = false;
    }
}

?>