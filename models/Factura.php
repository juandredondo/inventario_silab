<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_FACTURAS".
 *
 * @property integer $FACT_ID
 * @property string $FACT_CODIGO
 * @property string $FACT_FECHA
 * @property string $FACT_IMAGEPATH
 * @property integer $PROV_ID
 * @property integer $PEDI_ID
 *
 * @property TBLPEDIDOS $pEDI
 * @property TBLPROVEDORES $pROV
 */
class Factura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_FACTURAS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FACT_CODIGO', 'PROV_ID'], 'required'],
            [['FACT_FECHA'], 'safe'],
            [['FACT_IMAGEPATH'], 'string'],
            [['PROV_ID', 'PEDI_ID'], 'integer'],
            [['FACT_CODIGO'], 'string', 'max' => 100],
            [['PEDI_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['PEDI_ID' => 'PEDI_ID']],
            [['PROV_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Provedores::className(), 'targetAttribute' => ['PROV_ID' => 'PROV_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FACT_ID' => 'Fact  ID',
            'FACT_CODIGO' => 'Fact  Codigo',
            'FACT_FECHA' => 'Fact  Fecha',
            'FACT_IMAGEPATH' => 'Fact  Imagepath',
            'PROV_ID' => 'Prov  ID',
            'PEDI_ID' => 'Pedi  ID',
        ];
    }

    public function getId() {
        return $this->FACT_ID;
    }
    public function setId($value = '') {
         $this->FACT_ID = $value;
    }

    public function getCodigo() {
        return $this->FACT_CODIGO;
    }
    public function setCodigo($value = '') {
         $this->FACT_CODIGO = $value;
    }

    public function getFecha() {
        return $this->FACT_FECHA;
    }
    public function setFecha($value = '') {
         $this->FACT_FECHA = $value;
    }

    public function getImagePath() {
        return $this->FACT_IMAGEPATH;
    }
    public function setImagePath($value = '') {
         $this->FACT_IMAGEPATH = $value;
    }

    public function getProvedorId() {
        return $this->PROV_ID;
    }
    public function setProvedorId($value = '') {
         $this->PROV_ID = $value;
    }

    public function getPedidoId() {
        return $this->PEDI_ID;
    }
    public function setPedidoId($value = '') {
         $this->PEDI_ID = $value;
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
    public function getProvedor()
    {
        return $this->hasOne(Provedor::className(), ['PROV_ID' => 'PROV_ID']);
    }
}
