<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_STOCK".
 *
 * @property integer $STOC_ID
 * @property integer $ITEM_ID
 * @property integer $INVE_ID
 * @property double $STOC_CANTIDAD
 *
 * @property TBLFLUJOS[] $tBLFLUJOSs
 * @property TBLINVENTARIOS $iNVE
 * @property TBLITEMS $iTEM
 */
class Stock extends \yii\db\ActiveRecord
{
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
            [['ITEM_ID', 'INVE_ID'], 'required'],
            [['ITEM_ID', 'INVE_ID'], 'integer'],
            [['STOC_CANTIDAD'], 'number'],
            [['INVE_ID', 'ITEM_ID'], 'unique', 'targetAttribute' => ['INVE_ID', 'ITEM_ID'], 'message' => 'The combination of Item  ID and Inve  ID has already been taken.'],
            [['INVE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Inventario::className(), 'targetAttribute' => ['INVE_ID' => 'INVE_ID']],
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STOC_ID' => 'Stoc  ID',
            'ITEM_ID' => 'Item  ID',
            'INVE_ID' => 'Inve  ID',
            'STOC_CANTIDAD' => 'Stoc  Cantidad',
        ];
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
        return $this->hasOne(Item::className(), ['ITEM_ID' => 'ITEM_ID']);
    }
}
