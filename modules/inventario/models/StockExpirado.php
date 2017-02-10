<?php

namespace app\modules\inventario\models;

use Yii;

/**
 * This is the model class for table "TBL_STOCKVENCIMIENTOS".
 *
 * @property integer $STVE_ID
 * @property integer $FLUJ_ID
 * @property boolean $STVE_VENCIDO
 * @property string $STVE_FECHAVENCIMIENTO
 */
class StockExpirado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_STOCKVENCIMIENTOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FLUJ_ID', 'STVE_FECHAVENCIMIENTO'], 'required'],
            [['FLUJ_ID'], 'integer'],
            [['STVE_VENCIDO'], 'boolean'],
            [['STVE_FECHAVENCIMIENTO'], 'safe'],
            [['FLUJ_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Flujo::className(), 'targetAttribute' => ['FLUJ_ID' => 'FLUJ_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STVE_ID'               => 'ID',
            'FLUJ_ID'               => 'FLUJO',
            'STVE_VENCIDO'          => 'VENCIDO',
            'STVE_FECHAVENCIMIENTO' => 'FECHA DE VENCIMIENTO',
        ];
    }
}
