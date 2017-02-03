<?php

namespace app\modules\inventario\models\views;

use Yii;
use app\modules\inventario\models\Stock;

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
class VStockActual extends Stock
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
            'STOC_ID' => 'STOCK',
            'ITEM_ID' => 'ITEM',
            'INVE_ID' => 'INVENTARIO',
            'STOC_CANTIDAD' => 'CANTIDAD EN STOCK',
            'PERI_ID' => 'PERIODO VIGENTE',
            'STOC_ESCONSUMIBLE' => 'CATEGORIA',
            'ITEM_NOMBRE' => 'NOMBRE',
            'TIIT_ID' => 'TIPO ID',
            'TIIT_NOMBRE' => 'TIPO DE ITEM',
        ];
    }

}
