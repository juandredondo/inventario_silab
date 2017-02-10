<?php

namespace app\modules\inventario\models\views;

use Yii;
use app\modules\inventario\models\Stock;
use app\modules\inventario\models\core\TipoItem;
use app\modules\inventario\models\Material;
use app\modules\inventario\models\Reactivo;
use app\modules\inventario\models\Accesorios;
use app\modules\inventario\models\Equipo;
use app\modules\inventario\models\Herramienta;

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

    public function fields()
    {
        $fields = parent::fields();
        $fields[ "consumibleInfo" ] = "itemConsumibleInfo";

        return $fields;
    }

   public function getItemConsumibleInfo()
   {
       if( $this->STOC_ESCONSUMIBLE )
       {
            switch( $this->TIIT_ID )
            {
                case TipoItem::Reactivo:
                    return Reactivo::getByItemId( $this->ITEM_ID );
                break;

                case TipoItem::Accesorio:
                    return Accesorios::getByItemId( $this->ITEM_ID );
                break;

                case TipoItem::Material:
                    return Material::getByItemId( $this->ITEM_ID );
                break;

                case TipoItem::Herramienta:
                    return Herramienta::getByItemId( $this->ITEM_ID );
                break;

                case TipoItem::Equipo:
                    return Equipo::getByItemId( $this->ITEM_ID );
                break;
            }
       }
       else
        return null;
   }

}
