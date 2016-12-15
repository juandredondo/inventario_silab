<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_SIMBOLOS".
 *
 * @property integer $SIMB_ID
 * @property string $SIMB_NOMBRE
 * @property string $SIMB_CODIGO
 *
 * @property TBLREACTIVOS[] $tBLREACTIVOSs
 */
class Simbolo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_SIMBOLOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SIMB_NOMBRE'], 'required'],
            [['SIMB_NOMBRE'], 'string', 'max' => 100],
            [['SIMB_CODIGO'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SIMB_ID' => 'Simb  ID',
            'SIMB_NOMBRE' => 'Simb  Nombre',
            'SIMB_CODIGO' => 'Simb  Codigo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReactivos()
    {
        return $this->hasMany(Reactivo::className(), ['SIMB_ID' => 'SIMB_ID']);
    }
}
