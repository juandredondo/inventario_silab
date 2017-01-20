<?php

namespace app\modules\inventario\models;

use app\modules\inventario\models\Stock;
use app\models\Movimiento;
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
            [['FLUJ_FECHA'], 'datetime'],
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
            'FLUJ_ID'       => 'ID',
            'FLUJ_CANTIDAD' => 'CANTIDAD',
            'FLUJ_FECHA' => 'FECHA',
            'MOVI_ID' => 'MOVIMIENTO',
            'STOC_ID' => 'STOCK',
            'TIFU_ID' => 'TIPO',
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

    public function getFecha() {
        return $this->FLUJ_FECHA;
    }
    public function setFecha($value = '') {
         $this->FLUJ_FECHA = $value;
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

    /**
    * Obtiene las entradas o salidas del item en un inventario (stock_id)
    * @author Jeancarlo Fontalvo
    * @param entero $id representa el id del stock
    * @param entero $tipo representa el tipo de flujo, sea entrada o salida
    * @since 1.0.2
    */
    public static function getFlowsByStockId($id, $tipo = TipoFlujo::Entrada)
    {
        $return = static::find()->where([ "STOC_ID" => $id, "TIFU_ID" => $tipo ])->all();
        if(isset($return))
        {
            return $return;
        }
        else
            return [];
    }

}
