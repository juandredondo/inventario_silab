<?php

namespace app\models;
use app\modules\inventario\models\Stock;

use Yii;

/**
 * This is the model class for table "TBL_FLUJOS".
 *
 * @property integer $FLUJ_ID
 * @property double $FLUJ_CANTIDAD
 * @property integer $MOVI_ID
 * @property integer $STOC_ID
 * @property integer $TIFU_ID
 *
 * @property TBLMOVIMIENTOS $mOVI
 * @property TBLSTOCK $sTOC
 * @property TBLTIPOFLUJO $tIFU
 */
class Flujo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_FLUJOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FLUJ_CANTIDAD', 'STOC_ID'], 'required'],
            [['FLUJ_CANTIDAD'], 'number'],
            [['MOVI_ID', 'STOC_ID', 'TIFU_ID'], 'integer'],
            [['MOVI_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Movimiento::className(), 'targetAttribute' => ['MOVI_ID' => 'MOVI_ID']],
            [['STOC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Stock::className(), 'targetAttribute' => ['STOC_ID' => 'STOC_ID']],
            [['TIFU_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoFlujo::className(), 'targetAttribute' => ['TIFU_ID' => 'TIFL_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FLUJ_ID' => 'Fluj  ID',
            'FLUJ_CANTIDAD' => 'Fluj  Cantidad',
            'MOVI_ID' => 'Movi  ID',
            'STOC_ID' => 'Stoc  ID',
            'TIFU_ID' => 'Tifu  ID',
        ];
    }

    public function getId() {
        return $this->FLUJ_ID;
    }
    public function setId($value = '') {
         $this->FLUJ_ID = $value;
    }

    public function getCantidad() {
        return $this->FLUJ_CANTIDAD;
    }
    public function setCantidad($value = '') {
         $this->FLUJ_CANTIDAD = $value;
    }

    public function getMovimientoId() {
        return $this->MOVI_ID;
    }
    public function setMovimientoId($value = '') {
         $this->MOVI_ID = $value;
    }

    public function getStockId() {
        return $this->STOC_ID;
    }
    public function setStockId($value = '') {
         $this->STOC_ID = $value;
    }

    public function getTipoFlujoId() {
        return $this->TIFU_ID;
    }
    public function setTipoFlujoId($value = '') {
         $this->TIFU_ID = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimiento()
    {
        return $this->hasOne(Movimiento::className(), ['MOVI_ID' => 'MOVI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStock()
    {
        return $this->hasOne(Stock::className(), ['STOC_ID' => 'STOC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoFlujo()
    {
        return $this->hasOne(TipoFlujo::className(), ['TIFL_ID' => 'TIFU_ID']);
    }
}
