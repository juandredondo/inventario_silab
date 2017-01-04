<?php

namespace app\modules\inventario\models;

use Yii;
use app\modules\inventario\models\core\ItemNoConsumible;
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
class Accesorios extends \app\modules\inventario\models\core\ItemBase
{
    protected static $parentIdProperty   = "ITNC_ID";

    public static function getType()
    {
        return \app\modules\inventario\models\core\TipoItem::Accesorio;
    }

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
            'ACCE_ID' => 'ID',
            'ACCE_SERIAL' => 'SERIAL',
            'ACCE_MODELO' => 'MODELO',
            'ITNC_ID' => 'NO CONSUMIBLE',
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
    public function getItemNoConsumible()
    {
        return $this->hasOne(ItemNoConsumible::className(), ['ITNC_ID' => 'ITNC_ID']);
    }


}
