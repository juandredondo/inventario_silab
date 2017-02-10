<?php

namespace app\modules\inventario\models;

use Yii;
use app\modules\inventario\models\core\Items;
use app\models\Periodo;
use app\models\Laboratorio;
/**
 * This is the model class for table "TBL_STOCK".
 *
 * @property integer $STOC_ID
 * @property integer $ITEM_ID
 * @property integer $INVE_ID
 * @property double $STOC_CANTIDAD
* @property integer $PERI_ID 
* @property integer $CADU_ID 
* @property boolean $STOC_ESCONSUMIBLE 
* @property integer $LABO_ID 
* @property double $STOC_MIN 
* @property double $STOC_MAX 
 *
 * @property TBLFLUJOS[] $tBLFLUJOSs
 * @property TBLINVENTARIOS $iNVE
 * @property TBLITEMS $iTEM
 * @property TBLPERIODOS $pERI 
 * @property TBLCADUCIDADES $cADU 
 * @property TBLLABORATORIOS $lABO 
 * @property TBLSTOCKCONFIGS[] $tBLSTOCKCONFIGSs 
 */
class Stock extends \yii\db\ActiveRecord
{
    // Algoritmos para el calculo 
    public $calculador;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_STOCK';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['ITEM_ID', 'INVE_ID', 'STOC_CANTIDAD', 'PERI_ID', 'STOC_MIN'], 'required'],
           [['ITEM_ID', 'INVE_ID', 'PERI_ID', 'CADU_ID', 'LABO_ID'], 'integer'],
           [['STOC_CANTIDAD', 'STOC_MIN', 'STOC_MAX'], 'number'],
           [['STOC_ESCONSUMIBLE'], 'boolean'],
           [['INVE_ID', 'ITEM_ID', 'PERI_ID'], 'unique', 'targetAttribute' => ['INVE_ID', 'ITEM_ID', 'PERI_ID'], 'message' => 'Ya existe item en stock'],
           [['INVE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Inventario::className(), 'targetAttribute' => ['INVE_ID' => 'INVE_ID']],
           [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_ID']],
           [['PERI_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Periodo::className(), 'targetAttribute' => ['PERI_ID' => 'PERI_ID']],
           [['CADU_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Caducidad::className(), 'targetAttribute' => ['CADU_ID' => 'CADU_ID']],
           [['LABO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Laboratorio::className(), 'targetAttribute' => ['LABO_ID' => 'LABO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STOC_ID' => 'STOCK',
            'ITEM_ID' => 'ITEM',
            'INVE_ID' => 'INVENTARIO',
            'STOC_CANTIDAD'     => 'CANTIDAD',
            'PERI_ID'           => 'PERIODO',
            'CADU_ID'           => 'VENCIMIENTO',
            'STOC_ESCONSUMIBLE' => 'CATEGORIA',
            'LABO_ID'           => 'LABORATORIO',
            'STOC_MIN'          => 'MINIMAS',
            'STOC_MAX'          => 'MAXIMAS',
        ];
    }

    public function getId() {
        return $this->STOC_ID;
    }
    public function setId($value = '') {
         $this->STOC_ID = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlujos()
    {
        return $this->hasMany(Flujo::className(), ['STOC_ID' => 'STOC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventario()
    {
        return $this->hasOne(Inventario::className(), ['INVE_ID' => 'INVE_ID']);
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
   public function getPeriodo()
   {
       return $this->hasOne(Periodo::className(), ['PERI_ID' => 'PERI_ID']);
   }

   public static function getCurrentStock($item, $inventory)
   {
        $stock = static::find()
                ->where([ "ITEM_ID" => $item, 'INVE_ID' => $inventory ])
                ->limit(1)
                ->orderBy('STOC_ID DESC')
                ->one();

        return $stock;
   }

   /**
   * @return \yii\db\ActiveQuery
    */
   public function getCaducidad()
   {
       return $this->hasOne(Caducidad::className(), ['CADU_ID' => 'CADU_ID']);
   }

   public function getLaboratorio()
   {
       return $this->hasOne(Laboratorio::className(), ['LABO_ID' => 'LABO_ID']);
   }

   /**
    * @return \yii\db\ActiveQuery
    */
   public function getCurrentConfig()
   {
       return $this->hasMany(TBLSTOCKCONFIGS::className(), ['STOC_ID' => 'STOC_ID']);
   }

   public function calculateAmount()
   {
       // flujos del stock
       $flows           = $this->flujos;
       // monto temporal
       $amount          = 0;

       // 1. Si tiene flujos, entonces se proxigen a calcularse
       if(count($flows) > 0)
       {
           $amount = 0;
           foreach($flows as $flow)
           {
               // 2.    Se calcula el monto, ya se sumando o restando el flujo 
               //       (definido por su constante)
               $calculated  = $flow->calculateWithAmount($amount);               
               $amount      = $calculated[ "amount" ];
           }
           
           // 3. Actualizar el monto, si es diferente del actual
           if($amount !== $currentAmount && $amount > -1)
           {
               $this->STOC_CANTIDAD = $amount;
               $this->update(true, [ "STOC_CANTIDAD" ]);
           }
       }
       
       return $this->STOC_CANTIDAD;
   }

   public static function getEmptyItems()
   {
       $db       = Yii::$app->db->createCommand("CALL getEmptyItems()");
       $stocks   = $db->queryAll();

       return $stocks;
   }

}
