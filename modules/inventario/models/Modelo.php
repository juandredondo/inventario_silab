<?php

namespace app\modules\inventario\models;

use Yii;

/**
 * This is the model class for table "TBL_MODELO".
 *
 * @property integer $MODE_ID
 * @property string $MODE_CODIGO
 * @property integer $MODE_EMPTY
 *
 * @property TBLITEMSNOCONSUMIBLES[] $tBLITEMSNOCONSUMIBLESs
 */
class Modelo extends \yii\db\ActiveRecord
{
    const SinModelo    = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_MODELO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MODE_CODIGO'], 'required'],
            [['MODE_EMPTY'], 'integer'],
            [['MODE_CODIGO'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MODE_ID' => 'Mode  ID',
            'MODE_CODIGO' => 'Mode  Codigo',
            'MODE_EMPTY' => 'Mode  Empty',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNoConsumible()
    {
        return $this->hasMany(ItemNoConsumible::className(), ['MODE_ID' => 'MODE_ID']);
    }
}
