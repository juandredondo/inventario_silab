<?php

namespace app\modules\inventario\models;

use Yii;

/**
 * This is the model class for table "TBL_ACCESORIOS".
 *
 * @property integer $ACCE_ID
 * @property string $ACCE_SERIAL
 * @property string $ACCE_MODELO
 * @property integer $ITNC_ID
 *
 * @property TBLITEMSNOCONSUMIBLES $iTNC
 */
class Accesorios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_ACCESORIOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCE_SERIAL', 'ITNC_ID'], 'required'],
            [['ITNC_ID'], 'integer'],
            [['ACCE_SERIAL', 'ACCE_MODELO'], 'string', 'max' => 45],
            [['ITNC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemNoConsumible::className(), 'targetAttribute' => ['ITNC_ID' => 'ITNC_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ACCE_ID' => 'Acce  ID',
            'ACCE_SERIAL' => 'Acce  Serial',
            'ACCE_MODELO' => 'Acce  Modelo',
            'ITNC_ID' => 'Itnc  ID',
        ];
    }

    public function getId(){ 
        return $this->ACCE_ID; 
    }
    public function setId($value){ 
        $this->ACCE_ID = $value; 
    }

    public function getSerial(){ 
        return $this->ACCE_SERIAL; 
    }
    public function setSerial($value){ 
        $this->ACCE_SERIAL = $value; 
    }

    public function getModelo(){ 
        return $this->ACCE_MODELO; 
    }
    public function setModelo($value){ 
        return $this->ACCE_MODELO = $value; 
    }

    public function getItemId(){ 
        return $this->ACCE_ITNC_ID; 
    }
    public function setItemId($value){ 
        return $this->ACCE_ITNC_ID = $value; 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITNC()
    {
        return $this->hasOne(ItemNoConsumible::className(), ['ITNC_ID' => 'ITNC_ID']);
    }


}
