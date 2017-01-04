<?php

namespace app\modules\inventario\models;

use Yii;
use app\modules\inventario\core\models\Items;

use app\models\Laboratorio;
use app\models\Periodo;

/**
 * This is the model class for table "TBL_INVENTARIOS".
 *
 * @property integer $INVE_ID
 * @property string $INVE_NOMBRE
 * @property integer $LABO_ID
 * @property double $INVE_CANTIDAD
 * @property integer $PERI_ID
 *
 * @property TBLLABORATORIOS $lABO
 * @property TBLPERIODOS $pERI
 * @property TBLSTOCK[] $tBLSTOCKs
 * @property TBLITEMS[] $iTEMs
 */
class Inventario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_INVENTARIOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INVE_PADRE', 'LABO_ID', 'PERI_ID'], 'integer'], 
            [['LABO_ID', 'PERI_ID'], 'required'],
            [['INVE_CANTIDAD'], 'number'],
            [['INVE_NOMBRE'], 'string', 'max' => 200],
            [['INVE_DESCRIPCION'], 'string'],
            [['INVE_ALIAS'], 'string', 'max' => 255],
            [['INVE_ALIAS'], 'unique'],
            [['LABO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Laboratorio::className(), 'targetAttribute' => ['LABO_ID' => 'LABO_ID']],
            [['PERI_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Periodo::className(), 'targetAttribute' => ['PERI_ID' => 'PERI_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INVE_ID'           => 'Inve ID',
            'INVE_NOMBRE'       => 'Inve Nombre',
            'INVE_DESCRIPCION'  => 'Inve Descripcion',
            'INVE_ALIAS'        => 'Inve Alias',
            'INVE_CANTIDAD'     => 'Inve Cantidad',
            'INVE_PADRE'        => 'Inve Padre',
            'LABO_ID'           => 'Labo ID',
            'PERI_ID'           => 'Peri ID',
        ];
    }

    public function getId() 
    {
        return $this->INVE_ID;
    }
    public function setId($value = '') 
    {
         $this->INVE_ID = $value;
    }

    public function getNombre() 
    {
        return $this->INVE_NOMBRE;
    }
    public function setNombre($value = '') 
    {
         $this->INVE_NOMBRE = $value;
    }
    
    public function getDescripcion() {
        return $this->INVE_DESCRIPCION;
    }
    public function setDescripcion($value = '') {
         $this->INVE_DESCRIPCION = $value;
    }

    public function getAlias() {
        return $this->INVE_ALIAS;
    }
    public function setAlias($value = '') {
         $this->INVE_ALIAS = $value;
    }

    public function getPadreId() {
        return $this->INVE_PADRE;
    }
    public function setPadreId($value = '') {
         $this->INVE_PADRE = $value;
    }
    /**
    * @desprecated
    */
        public function getCantidad() 
        {
            return $this->INVE_CANTIDAD;
        }
        public function setCantidad($value = '') 
        {
            $this->INVE_CANTIDAD = $value;
        }

    public function getLaboratorioId() 
    {
        return $this->LABO_ID;
    }
    public function setLaboratorioId($value = '') 
    {
         $this->LABO_ID = $value;
    }

    public function getPeriodoId() 
    {
        return $this->PERI_ID;
    }
    public function setPeriodoId($value = '') 
    {
         $this->PERI_ID = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaboratorio()
    {
        return $this->hasOne(Laboratorio::className(), ['LABO_ID' => 'LABO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodo()
    {
        return $this->hasOne(Periodo::className(), ['PERI_ID' => 'PERI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['INVE_ID' => 'INVE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['ITEM_ID' => 'ITEM_ID'])->viaTable('TBL_STOCK', ['INVE_ID' => 'INVE_ID']);
    }

   /**
    * @return \yii\db\ActiveQuery
    */
   public function getLaboratoriosCompartidos()
   {
       return $this->hasMany(Laboratorio::className(), ['LABO_ID' => 'LABO_ID'])->viaTable('TBL_INVENTARIOSCOMPARTIDOS', ['INVE_ID' => 'INVE_ID']);
   }
}
