<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_PERIODOS".
 *
 * @property integer $PERI_ID
 * @property integer $PERI_SEMESTRE
 * @property string $PERI_FECHA
 *
 * @property TBLINVENTARIOS[] $tBLINVENTARIOSs
 */
class Periodo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_PERIODOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PERI_SEMESTRE'], 'required'],
            [['PERI_SEMESTRE'], 'integer'],
            [['PERI_FECHA'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PERI_ID' => 'Peri  ID',
            'PERI_SEMESTRE' => 'Peri  Semestre',
            'PERI_FECHA' => 'Peri  Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['PERI_ID' => 'PERI_ID']);
    }
}
