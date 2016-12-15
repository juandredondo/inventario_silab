<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_EQUIPOS".
 *
 * @property integer $EQUI_ID
 * @property string $EQUI_SERIAL
 * @property integer $ITNC_ID
 *
 * @property TBLITEMSNOCONSUMIBLES $iTNC
 */
class Equipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_EQUIPOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EQUI_SERIAL', 'ITNC_ID'], 'required'],
            [['ITNC_ID'], 'integer'],
            [['EQUI_SERIAL'], 'string', 'max' => 100],
            [['ITNC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemNoConsumible::className(), 'targetAttribute' => ['ITNC_ID' => 'ITNC_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EQUI_ID' => 'Equi  ID',
            'EQUI_SERIAL' => 'Equi  Serial',
            'ITNC_ID' => 'Itnc  ID',
        ];
    }

    public function getId() {
        return $this->EQUI_ID;
    }
    public function setId($value = '') {
         $this->EQUI_ID = $value;
    }

    public function getSerial() {
        return $this->EQUI_SERIAL;
    }
    public function setSerial($value = '') {
         $this->EQUI_SERIAL = $value;
    }

    public function getNoConsumibleId() {
        return $this->ITNC_ID;
    }
    public function setNoConsumibleId($value = '') {
         $this->ITNC_ID = $value;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNoConsumible()
    {
        return $this->hasOne(ItemNoComsumible::className(), ['ITNC_ID' => 'ITNC_ID']);
    }
}
