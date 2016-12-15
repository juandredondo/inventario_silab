<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_DETALLEPEDIDOS".
 *
 * @property integer $DEPE_ID
 * @property double $DEPE_CANTIDAD
 * @property integer $PEDI_ID
 * @property integer $ITEM_ID
 *
 * @property TBLPEDIDOS $pEDI
 * @property TBLITEMS $iTEM
 */
class DetallePedido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_DETALLEPEDIDOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DEPE_CANTIDAD'], 'number'],
            [['PEDI_ID', 'ITEM_ID'], 'required'],
            [['PEDI_ID', 'ITEM_ID'], 'integer'],
            [['PEDI_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['PEDI_ID' => 'PEDI_ID']],
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DEPE_ID' => 'Depe  ID',
            'DEPE_CANTIDAD' => 'Depe  Cantidad',
            'PEDI_ID' => 'Pedi  ID',
            'ITEM_ID' => 'Item  ID',
        ];
    }

    public function getId() {
        return $this->DEPE_ID;
    }
    public function setId($value = '') {
         $this->DEPE_ID = $value;
    }

    public function getCantidad() {
        return $this->DEPE_CANTIDAD;
    }
    public function setCantidad($value = '') {
         $this->DEPE_CANTIDAD = $value;
    }

    public function getPedidoId() {
        return $this->PEDI_ID;
    }
    public function setPedidoId($value = '') {
         $this->PEDI_ID = $value;
    }

    public function getItemId() {
        return $this->ITEM_ID;
    }
    public function setItemId($value = '') {
         $this->ITEM_ID = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedido::className(), ['PEDI_ID' => 'PEDI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['ITEM_ID' => 'ITEM_ID']);
    }
}
