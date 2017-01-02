<?php

namespace app\modules\inventario\models\core;

use Yii;

/**
 * This is the model class for table "TBL_ESTADOSNOCONSUMIBLE".
 *
 * @property integer $ESNC_ID
 * @property string $ESNC_NOMBRE
 * @property string $ESNC_CODIGO
 *
 * @property TBLITEMSNOCONSUMIBLES[] $tBLITEMSNOCONSUMIBLESs
 */
class EstadoNoConsumible extends \yii\db\ActiveRecord
{
    const Bueno     = 1;
    const Dañado    = 2;
    const Agotado   = 3;

    public static $types = [
        "Bueno"       => self::Bueno,
        "Dañado"      => self::Dañado,
        "Agotado"     => self::Agotado,
    ];
    
    public static function getTypes()
    {
        return [
            [ 'id' => self::Bueno,        'name' => 'Bueno'  ],
            [ 'id' => self::Dañado,   	  'name' => 'Dañado' ],
            [ 'id' => self::Agotado,      'name' => 'Agotado']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_ESTADOSNOCONSUMIBLE';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ESNC_NOMBRE'], 'required'],
            [['ESNC_NOMBRE'], 'string', 'max' => 100],
            [['ESNC_CODIGO'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ESNC_ID' => 'Esnc  ID',
            'ESNC_NOMBRE' => 'Esnc  Nombre',
            'ESNC_CODIGO' => 'Esnc  Codigo',
        ];
    }

    public function getId() {
        return $this->ESNC_ID;
    }
    public function setId($value = '') {
         $this->ESNC_ID = $value;
    }

    public function getNombre() {
        return $this->ESNC_NOMBRE;
    }
    public function setNombre($value = '') {
         $this->ESNC_NOMBRE = $value;
    }

    public function getCodigo() {
        return $this->ESNC_CODIGO;
    }
    public function setCodigo($value = '') {
         $this->ESNC_CODIGO = $value;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsNoConsumibles()
    {
        return $this->hasMany(ItemNoConsumible::className(), ['ESNC_ID' => 'ESNC_ID']);
    }
}
