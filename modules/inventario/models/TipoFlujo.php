<?php

namespace app\modules\inventario\models;

use Yii;

/**
 * This is the model class for table "TBL_TIPOFLUJO".
 *
 * @property integer $TIFL_ID
 * @property string $TIFL_NOMBRE
 * @property double $TIFL_CONSTANTE
 *
 * @property TBLFLUJOS[] $tBLFLUJOSs
 */
class TipoFlujo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const Entrada   =  1;
    const Salida    =  2;
    public static function tableName()
    {
        return 'TBL_TIPOFLUJO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TIFL_CONSTANTE'], 'number'],
            [['TIFL_NOMBRE'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TIFL_ID' => 'Tifl  ID',
            'TIFL_NOMBRE' => 'Tifl  Nombre',
            'TIFL_CONSTANTE' => 'Tifl  Constante',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlujos()
    {
        return $this->hasMany(Flujo::className(), ['TIFU_ID' => 'TIFL_ID']);
    }
}
