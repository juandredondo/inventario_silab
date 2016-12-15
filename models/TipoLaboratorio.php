<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_TIPOLABORATORIOS".
 *
 * @property integer $TILA_ID
 * @property string $TILA_NOMBRE
 *
 * @property TBLLABORATORIOS[] $tBLLABORATORIOSs
 */
class TipoLaboratorio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_TIPOLABORATORIOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TILA_NOMBRE'], 'required'],
            [['TILA_NOMBRE'], 'string', 'max' => 70],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TILA_ID' => 'Tila  ID',
            'TILA_NOMBRE' => 'Tila  Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaboratorios()
    {
        return $this->hasMany(Laboratorio::className(), ['TILA_ID' => 'TILA_ID']);
    }
}
