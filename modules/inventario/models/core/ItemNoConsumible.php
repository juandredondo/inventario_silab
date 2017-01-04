<?php

namespace app\modules\inventario\models\core;

use Yii;
use app\components\core\IdentificableInterface;
use app\components\core\LoadableActiveRecord;
use app\modules\inventario\models\Modelo;
/**
 * This is the model class for table "TBL_ITEMSNOCONSUMIBLES".
 *
 * @property integer $ITNC_ID
 * @property integer $ITEM_ID
 * @property integer $ESNC_ID
 * @property integer $MODE_ID
 *
 * @property TBLACCESORIOS[] $tBLACCESORIOSs
 * @property TBLEQUIPOS[] $tBLEQUIPOSs
 * @property TBLHERRAMIENTAS[] $tBLHERRAMIENTASs
 * @property TBLESTADOSNOCONSUMIBLE $eSNC
 * @property TBLITEMS $iTEM
 * @property TBLMODELO $mODE
 */
class ItemNoConsumible extends LoadableActiveRecord implements IdentificableInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_ITEMSNOCONSUMIBLES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_ID', 'ESNC_ID', 'MODE_ID'], 'required'],
            [['ITEM_ID', 'ESNC_ID', 'MODE_ID'], 'integer'],
            [['ESNC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoNoConsumible::className(), 'targetAttribute' => ['ESNC_ID' => 'ESNC_ID']],
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_ID']],
            [['MODE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['MODE_ID' => 'MODE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITNC_ID' => 'NO CONSUMIBLE',
            'ITEM_ID' => 'ID',
            'ESNC_ID' => 'ESTADO',
            'MODE_ID' => 'MODELO',
        ];
    }

    public function getId() 
    {
        return $this->ITNC_ID;
    }
    public function setId($value = 0) 
    {
         $this->ITNC_ID = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesorios()
    {
        return $this->hasMany(Accesorios::className(), ['ITNC_ID' => 'ITNC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['ITNC_ID' => 'ITNC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHerramientas()
    {
        return $this->hasMany(Herramienta::className(), ['ITNC_ID' => 'ITNC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoNoConsumible()
    {
        return $this->hasOne(EstadoNoConsumible::className(), ['ESNC_ID' => 'ESNC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelo()
    {
        return $this->hasOne(Modelo::className(), ['MODE_ID' => 'MODE_ID']);
    }
}
