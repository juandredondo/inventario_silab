<?php

namespace app\models;

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
