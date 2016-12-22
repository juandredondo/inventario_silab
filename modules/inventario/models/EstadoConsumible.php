<?php

namespace app\modules\inventario\models;

use Yii;

/**
 * This is the model class for table "TBL_ESTADOSCONSUMIBLE".
 *
 * @property integer $ESCO_ID
 * @property string $ESCO_NOMBRE
 * @property integer $ESCO_MIN
 * @property integer $ESCO_MAX
 *
 * @property TBLITEMSCONSUMIBLES[] $tBLITEMSCONSUMIBLESs
 */
class EstadoConsumible extends \yii\db\ActiveRecord
{

    const Agotado       = 1;
    const Reponer       = 2;
    const Minimas       = 3;
    const Suficiente    = 4;

    public static $types = [
        "Agotado"       => self::Agotado,
        "Reponer"       => self::Reponer,
        "Minimas"       => self::Minimas,
        "Suficiente"    => self::Suficiente
    ];
    
    public static function getTypes()
    {
        return [
            [ 'id' => self::Agotado,        'name' => 'Agotado' ],
            [ 'id' => self::Reponer,   	    'name' => 'Reponer' ],
            [ 'id' => self::Minimas,        'name' => 'Minimas' ],
            [ 'id' => self::Suficientes,    'name' => 'Suficientes' ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_ESTADOSCONSUMIBLE';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ESCO_NOMBRE'], 'required'],
            [['ESCO_MIN', 'ESCO_MAX'], 'integer'],
            [['ESCO_NOMBRE'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ESCO_ID' => 'Esco  ID',
            'ESCO_NOMBRE' => 'Esco  Nombre',
            'ESCO_MIN' => 'Esco  Min',
            'ESCO_MAX' => 'Esco  Max',
        ];
    }

    public function getId() {
        return $this->ESCO_ID;
    }
    public function setId($value = '') {
         $this->ESCO_ID = $value;
    }

    public function getNombre() {
        return $this->ESCO_NOMBRE;
    }
    public function setNombre($value = '') {
         $this->ESCO_NOMBRE = $value;
    }

    public function getMin() {
        return $this->ESCO_MIN;
    }
    public function setMin($value = '') {
         $this->ESCO_MIN = $value;
    }

    public function getMax() {
        return $this->ESCO_MAX;
    }
    public function setMax($value = '') {
         $this->ESCO_MAX = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsConsumibles()
    {
        return $this->hasMany(ItemConsumible::className(), ['ESCO_ID' => 'ESCO_ID']);
    }
}
