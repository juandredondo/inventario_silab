<?php 

namespace app\modules\inventario\models\core;

use Yii;
use app\components\core\IdentificableInterface;
use app\config\SilabConfig;

use app\modules\inventario\models\core\TipoItem;
use app\modules\inventario\models\core\EstadoConsumible;
use app\modules\inventario\models\core\EstadoNoConsumible;

use app\modules\inventario\models\Modelo;

/**
* Esta es la base generica para los items 
* @property itemBase 
* @property itemType
* @author Jeancarlo Fontalvo 
* @since 1.0
*/
//\app\modules\inventario\models\core\Items
abstract class ItemBase extends \yii\db\ActiveRecord implements IdentificableInterface
{
    private          $_item              = nuLL;
    private          $_parent            = null;
    private          $_params            = [];
    protected static $parentIdProperty   = null;
    
    public function getItem() 
    {
        return $this->_item;
    }
    public function setItem(IdentificableInterface $value) 
    {
         $this->_item = $value;
    }

    public function getParent() 
    {
        if(!isset($this->_parent))
        {
            $baseClass              = static::getItemRelation()[ "class" ];
            $this->_parent          = new $baseClass;
            $this->_parent->ITEM_ID = 0;
        }

        return $this->_parent;
    }

    public function fillParents() 
    {
        if(!$this->isNewRecord)
        {
            $relatedFunc  = static::getItemRelation()["relation"];
            $this->parent = $this->$relatedFunc;
            $this->item   = $this->parent->item;
        }
    }

    public function getRelationPath($separator = ".") 
    {
        $relatedFunc  = static::getItemRelation()["relation"];
        return [
            "item" => $relatedFunc . $separator . "item",
            "parent" => $relatedFunc
        ];
    }

    public function setParent(IdentificableInterface $value) 
    {
         $this->_parent = $value;
    }

    public function setParentId($value)
    {
        $propertyId         = static::$parentIdProperty;
        $this->parent->id   = $value;
        $this->$propertyId  = $value;
    }

    /**
    * Sets the base info for the item
    */    
    protected static function base()
    {
        return [
            "name"  => "items",
            "class" => Items::className()
        ];
    }
    
    protected static function consumibleRelation ($itself = false)
    {
        return  [
            "class"     => ItemConsumible::className(),
            "relation"  => "itemConsumible",
            "itself"    => $itself
        ];
    }

    protected static function noConsumibleRelation ($itself = false)
    {
        return  [
            "class"     => ItemNoConsumible::className(),
            "relation"  => "itemNoConsumible",
            "itself"    => $itself
        ];
    }

    // Por defecto, se toma a los consumibles
    public static function getItemRelation()
    {   
        $parentType = TipoItem::getTypesById()[ static::getType() ];
        if($parentType[ "parent" ] != null)
            return ( $parentType[ "parent" ] == TipoItem::Consumible ) ? 
                    static::consumibleRelation() : static::noConsumibleRelation();
        else
            return ( $parentType[ "name" ] == TipoItem::Consumible ) ? 
                    static::consumibleRelation(true) : static::noConsumibleRelation(true);
    }

    public static function getType()
    {
        return null;
    }

    public function init()
    {
        if( static::getType() === null )
            throw new \yii\base\InvalidConfigException("Las clases derivadas de \"Items\" deben proporcionar un tipo de item (typeItem)");
        if( $this->item == null )
        {
            $baseClass              = static::base()[ "class" ];
            $this->item             = new $baseClass;
            $this->item->tipoItemId = static::getType();
        }

        if( TipoItem::getTypesById()[ static::getType() ][ "parent" ] == TipoItem::Consumible )
        {
            $this->parent->ITCO_MIN = SilabConfig::getCurrentConfig()->SILAB_STOCK_MIN;
            $this->parent->ITCO_MAX = SilabConfig::getCurrentConfig()->SILAB_STOCK_MAX;
        }
        
        parent::init();
    }

    /*protected function setType($id)
    {
        $this->typeItem = \app\modules\inventario\models\TipoItem::getTypesById()[ $id ];        
    }*/
    
    public static function getByItemId($id)
    {
        $class 		= get_called_class();
        $query      = $class::find()->joinWith(static::getItemRelation()["relation"])->where([ "ITEM_ID" => $id ]);
        $sql        = $query->createCommand()->getRawSql();
        $return 	= $query->one();
        
        if($return != null)
        {
            $return->fillParents();
        }
        return $return;
    }


    // Este metodo se llama antes del metodo save();
    public function prepareSave($params = [])
    {
        // 0. Incializacion de variables
        // 0.1. Obtenemos la relacion del item actual (Consumible o no consumible)
        $relation       = static::getItemRelation();
        // 0.2. Obtenemos el nombre de la clase que instancia a la categoria del item, (Consumible o no)
        $parentClass    = new $relation[ "class" ];
        // 0.3. La variable que se retornará donde, 
        // "base", es una instancia de la clase base Items
        // "parent", es una instancia de las clase de tipos de Item, dependiendo sea consumible o no
        // "status", representa el status de si se guardo o ha habido errores
        $returnedItem = [
            "status"    => new ItemStatus,
            "errors"    => []
        ];

        // 1. Guardar las bases del item, por ejemplo, si es un reactivo, que pertencese a la categoria
        // Consumible, entonces se guarda la cadena Item => Consumible => Reactivo
        // donde el utlimo paso, se realiza en la clase derivada de esta, en ese caso Reactivo.php}
        // - - - intetamos guardar el item - - - - -
        $returnedItem[ "status" ]->state = $this->item->save();
        // - - - verificamos que si, y procedemos con la cadena de la categoria
        if($returnedItem[ "status" ]->state)
        {
            switch( TipoItem::getTypesById( )[ static::getType() ][ "parent" ] )
            {
                // - - - intentamos guardar el consumible
                case TipoItem::Consumible:
                        if($this->isNewRecord)
                        {
                            $this->parent           = (isset($this->parent)) ? $this->parent :  new $parentClass;
                            $this->parent->ITEM_ID  = $this->item->id;
                            $this->parent->ESCO_ID  = $this->getByKey(
                                $params, 
                                "estado", 
                                isset($this->parent->ESCO_ID) ? $this->parent->ESCO_ID : EstadoConsumible::Agotado
                            );    
                        }
                break;
                // - - - intentamos guardar el no consumible
                default:
                        if($this->isNewRecord)
                        {
                            $this->parent = (isset($this->parent)) ? $this->parent :  new $parentClass;
                            $this->parent->ITEM_ID = $this->item->id;
                            $this->parent->ESNC_ID = $this->getByKey(
                                $params, 
                                "estado", 
                                EstadoNoConsumible::Bueno
                            );
                            $this->parent->MODE_ID = $this->getByKey(
                                $params, 
                                "modelo", 
                                Modelo::SinModelo
                            );
                        }                   
                break;
            }
        }
            
        $returnedItem[ "status" ]->state = $returnedItem[ "status" ]->state &&  $this->parent->save();

        $this->parentId = $this->parent->id;

        return $returnedItem;
    }
  
    /**
    * @param $array el arreglo que quiero obtener su valor
    * @param $key la clave para obtener del array
    * @param $default es el valor por defecto, si no existe la llave o el valor
    **/
    private function getByKey($array, $key, $default = null)
    {
        return ( isset($array) ) ? ( isset($array[ $key ]) ? $array[ $key ] : $default ) : $default;
    }

    public function beforeValidate()
    {
        if(parent::beforeValidate())
        {
            $attributes = null;
            
            if($this->isNewRecord)
            {
                $attributes = $this->parent->getAttributes();
                unset($attributes["ITEM_ID"]);
            }
            $result = $this->item->validate() && $this->parent->validate($attributes);
            
            return $result;
        }
        else
            return false;
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $result = $this->prepareSave( $this->prepareParams()  );

            return $result["status"]->state;
        }
        else
            return false;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        
        if ($this->getIsNewRecord()) 
        {
            return $this->insert($runValidation = true, $attributeNames = null);
        } 
        else 
        {
            return $this->update($runValidation = true, $attributeNames = null) !== false;
        }        
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        if($this->isNewRecord)
        {
            $attributeNames = isset($attributeNames) ? $attributeNames : $this->attributes;

            unset($attributeNames[ static::$parentIdProperty ]);
        }

        return parent::validate($attributeNames, $clearErrors);
    }

    private function prepareParams()
    {
        $params = $this->_params;
        $params                     = isset($params) ? $params : [];
        return $params;
    }

    public function injectParams($params)
    {
        $this->_params = $params;
        return $this;
    }

    public static function findOne($condition)
    {
        $result = parent::findOne($condition);
        if($result != null)
        {
            $result->fillParents();
        }

        return $result;
    }

    public function delete()
    {
        return $this->item->delete();
    }

    public function getIsExpirable()
    {
        return $this->item->isExpirable;
    }

    public function getIsConsumible()
    {
        $parentType = TipoItem::getTypesById()[ static::getType() ];
        
        if($parentType[ "parent" ] != null)
            return ( $parentType[ "parent" ] == TipoItem::Consumible );

        return false;
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields = array_merge(
            $fields,
            [
                "item",
                "parent",
                "isExpirable",
                "isConsumible",
            ]
        );

        return $fields;
    }

}

?>