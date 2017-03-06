<?php

namespace app\modules\inventario\models\core;

use Yii;
use app\modules\inventario\models as InventoryModels;

/**
 * This is the model class for table "TBL_RANGOSCONSUMIBLE".
 *
 * @property integer $RACO_ID
 * @property integer $ITCO_ID
 * @property integer $ESCO_ID
 * @property double $RACO_MIN
 * @property double $RACO_MAX
 * @property string $RACO_ALIAS
 *
 * @property TBLESTADOSCONSUMIBLE $eSCO
 * @property TBLITEMSCONSUMIBLES $iTCO
 */
class RangoConsumible extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_RANGOSCONSUMIBLE';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITCO_ID', 'ESCO_ID', 'RACO_MIN'], 'required'],
            [['ITCO_ID', 'ESCO_ID'], 'integer'],
            [['RACO_MIN', 'RACO_MAX'], 'number'],
            [['RACO_ALIAS'], 'string', 'max' => 45],
            [['ITCO_ID', 'ESCO_ID'], 'unique', 'targetAttribute' => ['ITCO_ID', 'ESCO_ID'], 'message' => 'The combination of Itco  ID and Esco  ID has already been taken.'],
            [['ESCO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InventoryModels\core\EstadoConsumible::className(), 'targetAttribute' => ['ESCO_ID' => 'ESCO_ID']],
            [['ITCO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InventoryModels\core\ItemConsumible::className(), 'targetAttribute' => ['ITCO_ID' => 'ITCO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RACO_ID'       => 'INTERVALO',
            'ITCO_ID'       => 'CONSUMIBLE',
            'ESCO_ID'       => 'ESTADP',
            'RACO_MIN'      => 'MINIMO',
            'RACO_MAX'      => 'MAXIMO',
            'RACO_ALIAS'    => 'ALIAS',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoConsumible()
    {
        return $this->hasOne(InventoryModels\core\EstadoConsumible::className(), ['ESCO_ID' => 'ESCO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemConsumible()
    {
        return $this->hasOne(InventoryModels\core\ItemConsumible::className(), ['ITCO_ID' => 'ITCO_ID']);
    }

    public function generateRangeFromStates()
    {
        $states = InventoryModels\core\EstadoConsumible::find()->all();
        $ranges = [];

        foreach( $states as $state ) 
        {
            $ranges[] = new RangoConsumible([
                "ESCO_ID"  => $state->id,
                "RACO_MIN" => $state->min,
                "RACO_MAX" => $state->max
            ]);
        }

        return $ranges;
    }
}
