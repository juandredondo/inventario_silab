<?php

namespace app\modules\inventario\models\core;

use Yii;

/**
 * This is the model class for table "TBL_TIPOSITEMS".
 *
 * @property integer $TIIT_ID
 * @property string $TIIT_NOMBRE
 * @property integer $TIIT_PADRE
 *
 * @property TBLITEMS[] $tBLITEMSs
 * @property TipoItem $tIITPADRE
 * @property TipoItem[] $tipoItems
 */
class TipoItem extends \yii\db\ActiveRecord
{
    const Consumible    = 1;
    const NoConsumible  = 2;
    const Reactivo      = 3;
    const Material      = 4;
    const Equipo        = 5;
    const Accesorio     = 6;
    const Herramienta   = 7; 
    // Constante para especificar todos los tipos de items    
    const ALL           = -1;     

    public static $types = [ 
        "consumible"    => self::Consumible, 
        "noConsumible"  => self::NoConsumible,
        "Reactivo"      => self::Reactivo,
        "Material"      => self::Material,
        "Equipo"        => self::Equipo,
        "Accesorio"     => self::Accesorio,
        "Herramienta"   => self::Herramienta
    ];

    public static function getTypes()
    {
        return [
            [ "id" => self::Consumible,     'name' => "CONSUMIBLE" ],
            [ "id" => self::NoConsumible,   'name' => "NOCONSUMIBLE" ],
            [ "id" => self::Reactivo,       'name' => "REACTIVO" ],
            [ "id" => self::Material,       'name' => "MATERIAL" ],
            [ "id" => self::Equipo,         'name' => "EQUIPO" ],
            [ "id" => self::Accesorio,      'name' => "ACCESORIO" ],
            [ "id" => self::Herramienta,    'name' => "HERRAMIENTA" ],
        ];
    }

    public static function getTypesById()
    {
        $types = [
            self::ALL => [
                'name'      => "TODOS",
                'parent'    => null,
                'id'        => self::ALL  
            ],
            self::Consumible => [
                'name'      => "CONSUMIBLE",
                'parent'    => null,
                'id'        => self::Consumible
            ],      
            self::NoConsumible => [
                'name'      => "NOCONSUMIBLE",
                'parent'    => null,
                'id'        => self::NoConsumible
            ], 
            self::Reactivo => [
                'name'      => "REACTIVO",
                'parent'    => self::Consumible,
                'id'        => self::Reactivo                
            ], 
            self::Material => [
                'name'      => "MATERIAL",
                'parent'    => self::Consumible,
                'id'        => self::Material  
            ], 
            self::Equipo => [
                'name'      => "EQUIPO",
                'parent'    => self::NoConsumible,
                'id'        => self::Equipo  
            ], 
            self::Accesorio => [
                'name'      => "ACCESORIO",
                'parent'    => self::NoConsumible,
                'id'        => self::Accesorio  
            ], 
            self::Herramienta => [
                'name'      => "HERRAMIENTA",
                'parent'    => self::NoConsumible,
                'id'        => self::Herramienta  
            ],  
        ];

        return $types;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_TIPOSITEMS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TIIT_NOMBRE'], 'required'],
            [['TIIT_PADRE'], 'integer'],
            [['TIIT_NOMBRE'], 'string', 'max' => 45],
            [['TIIT_PADRE'], 'exist', 'skipOnError' => true, 'targetClass' => TipoItem::className(), 'targetAttribute' => ['TIIT_PADRE' => 'TIIT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TIIT_ID' => 'Tiit  ID',
            'TIIT_NOMBRE' => 'Tiit  Nombre',
            'TIIT_PADRE' => 'Tiit  Padre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['TIIT_ID' => 'TIIT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPadre()
    {
        return $this->hasOne(TipoItem::className(), ['TIIT_ID' => 'TIIT_PADRE']);
    }

    public static function getPadreById($id)
    {
        return self::getTypesById()[ $id ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHijos()
    {
        return $this->hasMany(TipoItem::className(), ['TIIT_PADRE' => 'TIIT_ID']);
    }

    public function getPadreTable()
    {
        if( $this->padre->id == TipoItem::Consumible )
        {
            return ItemConsumible::className();
        }
        else
            return ItemNoConsumible::className();
    }
}
