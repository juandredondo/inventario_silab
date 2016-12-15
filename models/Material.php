<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_MATERIALES".
 *
 * @property integer $MATE_ID
 * @property string $MATE_MEDIDA
 * @property integer $ITCO_ID
 *
 * @property TBLITEMSCONSUMIBLES $iTCO
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_MATERIALES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITCO_ID'], 'required'],
            [['ITCO_ID'], 'integer'],
            [['MATE_MEDIDA'], 'string', 'max' => 45],
            [['ITCO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemConsumible::className(), 'targetAttribute' => ['ITCO_ID' => 'ITCO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MATE_ID' => 'Mate  ID',
            'MATE_MEDIDA' => 'Mate  Medida',
            'ITCO_ID' => 'Itco  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemConsumible()
    {
        return $this->hasOne(ItemConsumible::className(), ['ITCO_ID' => 'ITCO_ID']);
    }
}
