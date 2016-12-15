<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_MOVIMIENTOS".
 *
 * @property integer $MOVI_ID
 * @property string $MOVI_FECHA
 * @property string $MOVI_CODIGO
 * @property integer $TIMO_ID
 * @property integer $PERS_ID
 *
 * @property TBLFLUJOS[] $tBLFLUJOSs
 * @property TBLPERSONAS $pERS
 * @property TBLTIPOMOVIMIENTOS $tIMO
 * @property TBLPEDIDOS[] $tBLPEDIDOSs
 */
class Movimiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_MOVIMIENTOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MOVI_FECHA'], 'safe'],
            [['TIMO_ID', 'PERS_ID'], 'integer'],
            [['MOVI_CODIGO'], 'string', 'max' => 100],
            [['PERS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['PERS_ID' => 'PERS_ID']],
            [['TIMO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMovimiento::className(), 'targetAttribute' => ['TIMO_ID' => 'TIMO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MOVI_ID' => 'Movi  ID',
            'MOVI_FECHA' => 'Movi  Fecha',
            'MOVI_CODIGO' => 'Movi  Codigo',
            'TIMO_ID' => 'Timo  ID',
            'PERS_ID' => 'Pers  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlujos()
    {
        return $this->hasMany(Flujo::className(), ['MOVI_ID' => 'MOVI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['PERS_ID' => 'PERS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMovimiento()
    {
        return $this->hasOne(TipoMovimiento::className(), ['TIMO_ID' => 'TIMO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(TBLPEDIDOS::className(), ['MOVI_ID' => 'MOVI_ID']);
    }
}
