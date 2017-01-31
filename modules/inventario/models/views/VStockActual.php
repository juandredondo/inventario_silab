<?php

namespace app\modules\inventario\models\views;

use Yii;

/**
 * This is the model class for table "vm_stocks_actuales".
 *
 * @property integer $STOC_ID
 * @property integer $ITEM_ID
 * @property integer $INVE_ID
 * @property double $STOC_CANTIDAD
 * @property integer $PERI_ID
 * @property boolean $STOC_ESCONSUMIBLE
 * @property string $ITEM_NOMBRE
 * @property integer $TIIT_ID
 * @property string $TIIT_NOMBRE
 */
class VStockActual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vm_stocks_actuales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STOC_ID', 'ITEM_ID', 'INVE_ID', 'PERI_ID', 'TIIT_ID'], 'integer'],
            [['ITEM_ID', 'INVE_ID', 'PERI_ID', 'ITEM_NOMBRE', 'TIIT_ID', 'TIIT_NOMBRE'], 'required'],
            [['STOC_CANTIDAD'], 'number'],
            [['STOC_ESCONSUMIBLE'], 'boolean'],
            [['ITEM_NOMBRE'], 'string', 'max' => 200],
            [['TIIT_NOMBRE'], 'string', 'max' => 45],
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
            'PERI_ID' => 'Peri  ID',
            'STOC_ESCONSUMIBLE' => 'Stoc  Esconsumible',
            'ITEM_NOMBRE' => 'Item  Nombre',
            'TIIT_ID' => 'Tiit  ID',
            'TIIT_NOMBRE' => 'Tiit  Nombre',
        ];
    }
}
