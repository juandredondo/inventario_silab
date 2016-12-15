<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_REACTIVOS".
 *
 * @property integer $REAC_ID
 * @property string $REAC_CODIGO
 * @property string $REAC_UNIDAD
 * @property string $REAC_FECHA_VENCIMIENTO
 * @property integer $ITCO_ID
 * @property integer $UBIC_ID
 * @property integer $CADU_ID
 * @property integer $SIMB_ID
 *
 * @property TBLCADUCIDADES $cADU
 * @property TBLITEMSCONSUMIBLES $iTCO
 * @property TBLSIMBOLOS $sIMB
 * @property TBLUBICACIONES $uBIC
 */
class Reactivo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_REACTIVOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REAC_CODIGO', 'REAC_UNIDAD', 'REAC_FECHA_VENCIMIENTO', 'ITCO_ID', 'UBIC_ID', 'CADU_ID', 'SIMB_ID'], 'required'],
            [['REAC_FECHA_VENCIMIENTO'], 'safe'],
            [['ITCO_ID', 'UBIC_ID', 'CADU_ID', 'SIMB_ID'], 'integer'],
            [['REAC_CODIGO'], 'string', 'max' => 100],
            [['REAC_UNIDAD'], 'string', 'max' => 45],
            [['CADU_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Caducidad::className(), 'targetAttribute' => ['CADU_ID' => 'CADU_ID']],
            [['ITCO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemConsumible::className(), 'targetAttribute' => ['ITCO_ID' => 'ITCO_ID']],
            [['SIMB_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Simbolo::className(), 'targetAttribute' => ['SIMB_ID' => 'SIMB_ID']],
            [['UBIC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Ubicacion::className(), 'targetAttribute' => ['UBIC_ID' => 'UBIC_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REAC_ID' => 'Reac  ID',
            'REAC_CODIGO' => 'Reac  Codigo',
            'REAC_UNIDAD' => 'Reac  Unidad',
            'REAC_FECHA_VENCIMIENTO' => 'Reac  Fecha  Vencimiento',
            'ITCO_ID' => 'Itco  ID',
            'UBIC_ID' => 'Ubic  ID',
            'CADU_ID' => 'Cadu  ID',
            'SIMB_ID' => 'Simb  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaducidad()
    {
        return $this->hasOne(Caducidad::className(), ['CADU_ID' => 'CADU_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemConsumible()
    {
        return $this->hasOne(ItemConsumible::className(), ['ITCO_ID' => 'ITCO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimbolo()
    {
        return $this->hasOne(Simbolo::className(), ['SIMB_ID' => 'SIMB_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUbicacion()
    {
        return $this->hasOne(Ubicacion::className(), ['UBIC_ID' => 'UBIC_ID']);
    }
}
