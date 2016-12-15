<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_FLUJOS".
 *
 * @property integer $FLUJ_ID
 * @property double $FLUJ_CANTIDAD
 * @property integer $MOVI_ID
 * @property integer $STOC_ID
 * @property integer $TIFU_ID
 *
 * @property TBLMOVIMIENTOS $mOVI
 * @property TBLSTOCK $sTOC
 * @property TBLTIPOFLUJO $tIFU
 */
class Flujo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_FLUJOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FLUJ_CANTIDAD', 'STOC_ID'], 'required'],
            [['FLUJ_CANTIDAD'], 'number'],
            [['MOVI_ID', 'STOC_ID', 'TIFU_ID'], 'integer'],
            [['MOVI_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Movimiento::className(), 'targetAttribute' => ['MOVI_ID' => 'MOVI_ID']],
            [['STOC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Stock::className(), 'targetAttribute' => ['STOC_ID' => 'STOC_ID']],
            [['TIFU_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoFlujo::className(), 'targetAttribute' => ['TIFU_ID' => 'TIFL_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FLUJ_ID' => 'Fluj  ID',
            'FLUJ_CANTIDAD' => 'Fluj  Cantidad',
            'MOVI_ID' => 'Movi  ID',
            'STOC_ID' => 'Stoc  ID',
            'TIFU_ID' => 'Tifu  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMOVI()
    {
        return $this->hasOne(TBLMOVIMIENTOS::className(), ['MOVI_ID' => 'MOVI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTOC()
    {
        return $this->hasOne(TBLSTOCK::className(), ['STOC_ID' => 'STOC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTIFU()
    {
        return $this->hasOne(TBLTIPOFLUJO::className(), ['TIFL_ID' => 'TIFU_ID']);
    }
}
