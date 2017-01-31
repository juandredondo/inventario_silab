<?php

namespace app\modules\inventario\models\views;

use Yii;

/**
 * This is the model class for table "vm_expiration_dates".
 *
 * @property integer $STVE_ID
 * @property integer $FLUJ_ID
 * @property boolean $STVE_VENCIDO
 * @property string $STVE_FECHAVENCIMIENTO
 * @property integer $STOC_ID
 * @property string $FLUJ_FECHA
 */
class VEntradaExpirada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vm_expiration_dates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STVE_ID', 'FLUJ_ID', 'STOC_ID'], 'integer'],
            [['FLUJ_ID', 'STVE_FECHAVENCIMIENTO', 'STOC_ID'], 'required'],
            [['STVE_VENCIDO'], 'boolean'],
            [['STVE_FECHAVENCIMIENTO', 'FLUJ_FECHA'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STVE_ID' => 'Stve  ID',
            'FLUJ_ID' => 'Fluj  ID',
            'STVE_VENCIDO' => 'Stve  Vencido',
            'STVE_FECHAVENCIMIENTO' => 'Stve  Fechavencimiento',
            'STOC_ID' => 'Stoc  ID',
            'FLUJ_FECHA' => 'Fluj  Fecha',
        ];
    }
}
