<?php

namespace app\modules\inventario\models;

use Yii;

/**
 * This is the model class for table "TBL_UBICACIONES".
 *
 * @property integer $UBIC_ID
 * @property integer $UBIC_ESTANTE
 * @property integer $UBIC_NIVEL
 * @property string $UBIC_CODIGO
 *
 * @property TBLREACTIVOS[] $tBLREACTIVOSs
 */
class Ubicacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_UBICACIONES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UBIC_ESTANTE', 'UBIC_NIVEL'], 'required'],
            [['UBIC_ESTANTE', 'UBIC_NIVEL'], 'integer'],
            [['UBIC_CODIGO'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UBIC_ID' => 'Ubic  ID',
            'UBIC_ESTANTE' => 'Ubic  Estante',
            'UBIC_NIVEL' => 'Ubic  Nivel',
            'UBIC_CODIGO' => 'Ubic  Codigo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReactivos()
    {
        return $this->hasMany(Reactivo::className(), ['UBIC_ID' => 'UBIC_ID']);
    }
}
