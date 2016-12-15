<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_PEDIDOS".
 *
 * @property integer $PEDI_ID
 * @property string $PEDI_FECHA
 * @property string $PEDI_CODIGO
 * @property integer $MOVI_ID
 *
 * @property TBLDETALLEPEDIDOS[] $tBLDETALLEPEDIDOSs
 * @property TBLFACTURAS[] $tBLFACTURASs
 * @property TBLMOVIMIENTOS $mOVI
 */
class Pedido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_PEDIDOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PEDI_FECHA'], 'safe'],
            [['MOVI_ID'], 'required'],
            [['MOVI_ID'], 'integer'],
            [['PEDI_CODIGO'], 'string', 'max' => 100],
            [['MOVI_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Movimiento::className(), 'targetAttribute' => ['MOVI_ID' => 'MOVI_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PEDI_ID' => 'Pedi  ID',
            'PEDI_FECHA' => 'Pedi  Fecha',
            'PEDI_CODIGO' => 'Pedi  Codigo',
            'MOVI_ID' => 'Movi  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalles()
    {
        return $this->hasMany(DetallePedido::className(), ['PEDI_ID' => 'PEDI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['PEDI_ID' => 'PEDI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimiento()
    {
        return $this->hasOne(Movimiento::className(), ['MOVI_ID' => 'MOVI_ID']);
    }
}
