<?php 

namespace app\models;

/**
* Class for testing stuff
* @author Jeancarlo Fontalvo 
*/
class Test extends TestA
{
    public $id;
    public $name;

    protected static $tablename = "test";

    public static function tableName()
    {
        return self::$tablename;
    }

    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                [['name'], 'required'],
                [['id'], 'integer'],
                [['name'], 'string']
            ]
        );
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $parent = get_parent_class( get_class() );
        if($parent::save())
        {
            if ($this->getIsNewRecord()) 
            {
                return $this->insert($runValidation, $attributeNames);
            } 
            else 
            {
                return $this->update($runValidation, $attributeNames) !== false;
            }
        }
        
    }

    public function getTestA()
    {
        return $this->testA;
    }
}


?>