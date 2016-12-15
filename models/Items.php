<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_ITEMS".
 *
 * @property integer $ITEM_ID
 * @property string $ITEM_NOMBRE
 * @property string $ITEM_OBSERVACION
 * @property integer $MARC_ID
 *
 * @property TBLDETALLEPEDIDOS[] $tBLDETALLEPEDIDOSs
 * @property TBLMARCAS $mARC
 * @property TBLITEMSCONSUMIBLES[] $tBLITEMSCONSUMIBLESs
 * @property TBLITEMSNOCONSUMIBLES[] $tBLITEMSNOCONSUMIBLESs
 * @property TBLSTOCK[] $tBLSTOCKs
 * @property TBLINVENTARIOS[] $iNVEs
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_ITEMS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_NOMBRE'], 'required'],
            [['ITEM_OBSERVACION'], 'string'],
            [['MARC_ID'], 'integer'],
            [['ITEM_NOMBRE'], 'string', 'max' => 200],
            [['MARC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['MARC_ID' => 'MARC_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_ID' => 'Item  ID',
            'ITEM_NOMBRE' => 'Item  Nombre',
            'ITEM_OBSERVACION' => 'Item  Observacion',
            'MARC_ID' => 'Marc  ID',
        ];
    }

    public function getId() {
        return $this->ITEM_ID;
    }
    public function setId($value = '') {
         $this->ITEM_ID = $value;
    }

    public function getNombre() {
        return $this->ITEM_NOMBRE;
    }
    public function setNombre($value = '') {
         $this->ITEM_NOMBRE = $value;
    }

    public function getObservacion() {
        return $this->ITEM_OBSERVACION;
    }
    public function setObservacion($value = '') {
         $this->ITEM_OBSERVACION = $value;
    }

    public function getMarcaId() {
        return $this->MARC_ID;
    }
    public function setMarcaId($value = '') {
         $this->MARC_ID = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetallePedidos()
    {
        return $this->hasMany(DetallePedido::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarca()
    {
        return $this->hasOne(TBLMARCAS::className(), ['MARC_ID' => 'MARC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsConsumibles()
    {
        return $this->hasMany(TBLITEMSCONSUMIBLES::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsNoConsumibles()
    {
        return $this->hasMany(TBLITEMSNOCONSUMIBLES::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(TBLSTOCK::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['INVE_ID' => 'INVE_ID'])->viaTable('TBL_STOCK', ['ITEM_ID' => 'ITEM_ID']);
    }
}
