<?php

namespace app\models;

use Yii;
use app\modules\inventario\models as InventarioModels;
/**
 * This is the model class for table "TBL_DETALLESOLICITUDES".
 *
 * @property integer $DESO_ID
 * @property double $DESO_CANTIDAD
 * @property integer $SOLI_ID
 * @property integer $STOC_ID
 * @property boolean $DESO_VALIDO
 *
 * @property TBLSOLICITUDES $sTOC
 * @property TBLSTOCK $sTOC0
 */
class DetalleSolicitud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_DETALLESOLICITUDES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DESO_CANTIDAD'], 'number'],
            [['SOLI_ID', 'STOC_ID'], 'required'],
            [['SOLI_ID', 'STOC_ID'], 'integer'],
            [['DESO_VALIDO'], 'boolean'],
            [['STOC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Solicitud::className(), 'targetAttribute' => ['STOC_ID' => 'SOLI_ID']],
            [['STOC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InventarioModels\Stock::className(), 'targetAttribute' => ['STOC_ID' => 'STOC_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DESO_ID' => 'Deso  ID',
            'DESO_CANTIDAD' => 'Deso  Cantidad',
            'SOLI_ID' => 'Soli  ID',
            'STOC_ID' => 'Stoc  ID',
            'DESO_VALIDO' => 'Deso  Valido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTOC()
    {
        return $this->hasOne(Solicitud::className(), ['SOLI_ID' => 'STOC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStock()
    {
        return $this->hasOne(InventarioModels\Stock::className(), ['STOC_ID' => 'STOC_ID']);
    }

    /**
    * Add and item to details of order and preview the stock for the item
    * @param $item intero
    */
    public function add($item, $laboratory, $inferInventory = true)
    {
        // Not Implemented exception
        throw new Exception(); 
    }
}
