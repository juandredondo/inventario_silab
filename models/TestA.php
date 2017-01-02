<?php 

namespace app\models;

use app\components\core\InheritableActiveRecord;

/**
 * 
 */
class TestA extends InheritableActiveRecord
{
    public $testA;
    public $origin;

    protected static $tablename = "testa";

    public static function tableName()
    {
        return self::$tablename;
    }

    public function rules()
    {
        return [
            [['testA'], 'integer'],
            [['origin'], 'string'],
            [['testA', 'origin'], 'required']
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        return parent::save($runValidation, $attributeNames);
    }

    public function beforeSave($insert)
    {
        if ( parent::beforeSave($insert) ) 
        {
            // Set the current son
            parent::$currentClass = get_class();
            return true;
        } 
        else 
        {
            return false;
        }
    }

}


?>