<?php

namespace app\modules\inventario\models;

use Yii;

/**
 * This is the model class for table "TBL_CADUCIDADES".
 *
 * @property integer $CADU_ID
 * @property string $CADU_NOMBRE
 * @property integer $CADU_MIN
 * @property integer $CADU_MAX
 *
 * @property TBLREACTIVOS[] $tBLREACTIVOSs
 */
class Caducidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_CADUCIDADES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CADU_NOMBRE'], 'required'],
            [['CADU_MIN', 'CADU_MAX'], 'integer'],
            [['CADU_NOMBRE'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CADU_ID' => 'Cadu  ID',
            'CADU_NOMBRE' => 'Cadu  Nombre',
            'CADU_MIN' => 'Cadu  Min',
            'CADU_MAX' => 'Cadu  Max',
        ];
    }

    public function getId(){ 
        return $this->CADU_ID; 
    }
    public function setId($value){ 
        $this->CADU_ID = $value; 
    }

    public function getNombre(){ 
        return $this->CADU_NOMBRE; 
    }
    public function setSerial($value){ 
        $this->CADU_NOMBRE = $value; 
    }

    public function getMin(){ 
        return $this->CADU_MIN; 
    }
    public function setMin($value){ 
        return $this->CADU_MIN = $value; 
    }

    public function getMax() {
        return $this->CADU_MAX;
    }
    public function setMax($value = '') {
         $this->CADU_MAX = $value;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReactivos()
    {
        return $this->hasMany(Reactivo::className(), ['CADU_ID' => 'CADU_ID']);
    }
}
