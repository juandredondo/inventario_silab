<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_TIPOMOVIMIENTOS".
 *
 * @property integer $TIMO_ID
 * @property string $TIMO_NOMBRE
 *
 * @property TBLMOVIMIENTOS[] $tBLMOVIMIENTOSs
 */
class TipoMovimiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_TIPOMOVIMIENTOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TIMO_NOMBRE'], 'string', 'max' => 100],
            [['TIMO_NOMBRE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TIMO_ID' => 'Timo  ID',
            'TIMO_NOMBRE' => 'Timo  Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientos()
    {
        return $this->hasMany(Movimiento::className(), ['TIMO_ID' => 'TIMO_ID']);
    }
}
