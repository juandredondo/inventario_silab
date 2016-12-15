<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_TIPOSITEMS".
 *
 * @property integer $TIIT_ID
 * @property string $TIIT_NOMBRE
 * @property integer $TIIT_PADRE
 *
 * @property TBLITEMS[] $tBLITEMSs
 * @property TipoItem $tIITPADRE
 * @property TipoItem[] $tipoItems
 */
class TipoItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_TIPOSITEMS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TIIT_NOMBRE'], 'required'],
            [['TIIT_PADRE'], 'integer'],
            [['TIIT_NOMBRE'], 'string', 'max' => 45],
            [['TIIT_PADRE'], 'exist', 'skipOnError' => true, 'targetClass' => TipoItem::className(), 'targetAttribute' => ['TIIT_PADRE' => 'TIIT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TIIT_ID' => 'Tiit  ID',
            'TIIT_NOMBRE' => 'Tiit  Nombre',
            'TIIT_PADRE' => 'Tiit  Padre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['TIIT_ID' => 'TIIT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPadre()
    {
        return $this->hasOne(TipoItem::className(), ['TIIT_ID' => 'TIIT_PADRE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHijos()
    {
        return $this->hasMany(TipoItem::className(), ['TIIT_PADRE' => 'TIIT_ID']);
    }
}
