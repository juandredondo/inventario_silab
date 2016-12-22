<?php

namespace app\modules\inventario\models;

use Yii;

/**
 * This is the model class for table "TBL_INVENTARIOSCOMPARTIDOS".
 *
 * @property integer $INCO_ID
 * @property integer $INVE_ID
 * @property integer $LABO_ID
 *
 * @property TBLINVENTARIOS $iNVE
 * @property TBLLABORATORIOS $lABO
 */
class InventarioCompartido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_INVENTARIOSCOMPARTIDOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INVE_ID', 'LABO_ID'], 'required'],
            [['INVE_ID', 'LABO_ID'], 'integer'],
            [['INVE_ID', 'LABO_ID'], 'unique', 'targetAttribute' => ['INVE_ID', 'LABO_ID'], 'message' => 'The combination of Inve  ID and Labo  ID has already been taken.'],
            [['INVE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TBLINVENTARIOS::className(), 'targetAttribute' => ['INVE_ID' => 'INVE_ID']],
            [['LABO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TBLLABORATORIOS::className(), 'targetAttribute' => ['LABO_ID' => 'LABO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INCO_ID' => 'Inco  ID',
            'INVE_ID' => 'Inve  ID',
            'LABO_ID' => 'Labo  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINVE()
    {
        return $this->hasOne(TBLINVENTARIOS::className(), ['INVE_ID' => 'INVE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLABO()
    {
        return $this->hasOne(TBLLABORATORIOS::className(), ['LABO_ID' => 'LABO_ID']);
    }
}
