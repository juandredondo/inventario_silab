<?php

namespace app\modules\inventario\models;

use Yii;
use app\modules\inventario\models as InventoryModels;
use app\modules\inventario\models\core\Items;
use app\modules\inventario\models\core\TipoItem;
use app\modules\inventario\models\Flujo;
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
 * @property integer $TIIT_ID
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
            [['LABO_ID'], 'integer'], 
            [['INVE_CANTIDAD'], 'number'],
            [['INVE_NOMBRE'], 'string', 'max' => 200],
            [['INVE_DESCRIPCION'], 'string'],
            [['INVE_ESSINGLETON'], 'boolean'], 
            [['INVE_ALIAS'], 'string', 'max' => 255],
            [['INVE_ALIAS'], 'unique'],
            [['TIIT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoItem::className(), 'targetAttribute' => ['TIIT_ID' => 'TIIT_ID']],
            [['LABO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Laboratorio::className(), 'targetAttribute' => ['LABO_ID' => 'LABO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INVE_ID'           => 'ID',
            'INVE_NOMBRE'       => 'NOMBRE',
            'INVE_DESCRIPCION'  => 'DESCRIPCION',
            'INVE_ALIAS'        => 'ALIAS',
            'INVE_CANTIDAD'     => 'CANTIDAD DE ITEMS',
            'INVE_PADRE'        => 'PADRE',
            'LABO_ID'           => 'LABORATORIO',
            'INVE_ESSINGLETON'  => 'ES SINGLETON',
            'TIIT_ID'           => 'TIPO ITEM',
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

    public function getIsSingleton() {
        return $this->INVE_ESSINGLETON;
    }
    
    public function setIsSingleton($value) {
         $this->INVE_ESSINGLETON = $value;
    }

    public function getTipoItemId() {
        return $this->TIIT_ID;
    }
    public function setTipoItemId($value) {
         $this->TIIT_ID = $value;
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

   public function getTipoItem()
   {
       return $this->hasOne(TipoItem::className(), ['TIIT_ID' => 'TIIT_ID']);
   }

   public function getEntries()
   {
       // 1. Get the stocks from the Inventory
       $stocks  =  $this->stocks;
       // 2. Array of entries :v
       $entries = [];
       // 3. Retrieve each entries for each stock
       foreach($stocks as $stock)
       {
           $flows = Flujo::getFlowsByStockId($stock->id);
           
           if( count($flows) > 0 )
            array_push($entries, $flows);
       }
       // 4. Good bye 
       return $entries;
   }

   public function getOuts()
   {
       // 1. Get the stocks from the Inventory
       $stocks  =  $this->stocks;
       // 2. Array of entries :v
       $entries = [];
       // 3. Retrieve each entries for each stock
       foreach($stocks as $stock)
       {
           $flows = Flujo::getFlowsByStockId($stock->id, \app\modules\inventario\models\TipoFlujo::Salida);

           if( count($flows) > 0 )
            array_push($entries, $flows);
       }
       // 4. Good bye 
       return $entries;
   }

   public function getItemsStatistics()
   {
       $query = new \yii\db\Query();

       $query ->select(['type', 'count'])
              ->from('vw_count_type_items')
              ->where(['inventory' => $this->INVE_ID]);            

       return $query->all();
   }

   public function beforeValidate()
   {
       if(parent::beforeValidate())
       {
           $this->TIIT_ID = $this->TIIT_ID < 0 ? null : $this->TIIT_ID;
       }

       return true;
   }

   public static function getSingletons($returnQuery = false )
   {
       $query = static::find()->from("vm_singletons_inventories");
       
       if($returnQuery)
            return $query;
       
       return $query->all();
   }

   /**
   * Infiere el inventario al cual un item se va a guardar
   * @param integer $laboratory El laboratorio que se le asigna el item
   * @param ActiveRecord|integer $inventory  El inventario donde se guardara el item. Si no se especifica 
   * @param integer $itemType El item que se registrara en stock. Si se especifica su id, 
   * se buscará su modelo activo
   * se inferencia en los inventarios singleton y de acuerdo al tipo del item
   */
   public static function getInventory ($laboratoryId, $inventory, $itemType = null)
   {
        // 1.   Let's see if the laboratory has inventories
        //      If not, then try to get from singletons inventories
        if( is_numeric($inventory) ) {
            $findInventory = InventoryModels\Inventario::find()
                                ->where( [ "INVE_ID" => $inventory, "LABO_ID" => $laboratoryId ] );
            $singletonFind = InventoryModels\Inventario::getSingletons(true);

            $tempInventory = $findInventory->one();

            if( !isset($tempInventory) ) {
                $findInventory->where( [ "INVE_ID" => $inventory ] );

                $tempInventory = $findInventory->one();

                if( !isset($tempInventory) && $itemType != null ) {
                    $singletonFind->where( [ "TIIT_ID" => $itemType ] );
                }
                    
                $tempInventory = isset($tempInventory) ? $tempInventory : $singletonFind->one();
            }

            $inventory = $tempInventory;
        }
        else if( $itemType != null ) {
            $inventory = InventoryModels\Inventario::getSingletons(true)
                                                     ->where( [ "TIIT_ID" => $itemType ] )
                                                     ->one();
        }

        return $inventory;
   }
}
