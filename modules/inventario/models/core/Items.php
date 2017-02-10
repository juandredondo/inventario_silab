<?php

namespace app\modules\inventario\models\core;

use Yii;
use app\components\core\IdentificableInterface;
use app\modules\inventario\models As InventoryModels;
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
class Items extends \yii\db\ActiveRecord implements IdentificableInterface
{
    public $isAmazing = false; 
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
            [['ITEM_NOMBRE',  'MARC_ID', 'TIIT_ID'], 'required'],
            [['ITEM_OBSERVACION'], 'string'],
            [['MARC_ID', 'TIIT_ID'], 'integer'],
            [['ITEM_NOMBRE'], 'string', 'max' => 200],
            [['TIIT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoItem::className(), 'targetAttribute' => ['TIIT_ID' => 'TIIT_ID']],
            [['MARC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InventoryModels\Marca::className(), 'targetAttribute' => ['MARC_ID' => 'MARC_ID']],
            [['nombre', 'observacion'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_ID'           => 'ID',
            'ITEM_NOMBRE'       => 'NOMBRE',
            'ITEM_OBSERVACION'  => 'OBSERVACION',
            'MARC_ID'           => 'MARCA',
            'TIIT_ID'           => 'TIPO',
        ];
    }

    public function getId() 
    {
        return $this->ITEM_ID;
    }
    public function setId($value = 0) 
    {
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

    public function getTipoItemId() {
        return $this->TIIT_ID;
    }
    public function setTipoItemId($value = '') {
         $this->TIIT_ID = $value;
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
        return $this->hasOne(InventoryModels\Marca::className(), ['MARC_ID' => 'MARC_ID']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTipoItem()
    {
        return $this->hasOne(TipoItem::className(), ['TIIT_ID' => 'TIIT_ID']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsConsumibles()
    {
        return $this->hasMany(ItemConsumible::className(), ['ITEM_ID' => 'ITEM_ID']);
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
        return $this->hasMany(InventoryModels\Stock::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['INVE_ID' => 'INVE_ID'])->viaTable('TBL_STOCK', ['ITEM_ID' => 'ITEM_ID']);
    }

    public function getRealItemId()
    {
        $realId = 0;

        $item = $this->traverseInfo();

        if(isset($item))
            $realId = $item->id;

        return $realId;
    }

    public function getIsExpirable()
    {
        $query          = (new \yii\db\Query); 
        $isExpirable    = $query->select('isExpirableItem(:id)')
                                ->addParams([ ":id" => $this->id ])
                                ->scalar();
        return $isExpirable == 1 ? true: false;
    }

    /**
    * Retorna la subclase en funcion del tipo de item
    */
    public function traverseInfo()
    {
        switch( $this->TIIT_ID )
        {
            case TipoItem::Reactivo:
                return InventoryModels\Reactivo::getByItemId( $this->ITEM_ID );
            break;

            case TipoItem::Accesorio:
                return InventoryModels\Accesorios::getByItemId( $this->ITEM_ID );
            break;

            case TipoItem::Material:
                return InventoryModels\Material::getByItemId( $this->ITEM_ID );
            break;

            case TipoItem::Herramienta:
                return InventoryModels\Herramienta::getByItemId( $this->ITEM_ID );
            break;

            case TipoItem::Equipo:
                return InventoryModels\Equipo::getByItemId( $this->ITEM_ID );
            break;

            default: 
                return null;
            break;
        }
    }
}
