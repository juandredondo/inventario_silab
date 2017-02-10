<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_ESTADOSOLICITUD".
 *
 * @property integer $ESSO_ID
 * @property integer $ESSO_NOMBRE
 * @property integer $ESSO_ORDEN
 * @property integer $ESSO_PARENT
 *
 * @property EstadoSolicitud $eSSOPARENT
 * @property EstadoSolicitud[] $estadoSolicituds
 * @property TBLSOLICITUDES[] $tBLSOLICITUDESs
 */
class EstadoSolicitud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_ESTADOSOLICITUD';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ESSO_NOMBRE'], 'required'],
            [['ESSO_NOMBRE', 'ESSO_ORDEN', 'ESSO_PARENT'], 'integer'],
            [['ESSO_PARENT'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoSolicitud::className(), 'targetAttribute' => ['ESSO_PARENT' => 'ESSO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ESSO_ID' => 'Esso  ID',
            'ESSO_NOMBRE' => 'Esso  Nombre',
            'ESSO_ORDEN' => 'Esso  Orden',
            'ESSO_PARENT' => 'Esso  Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getESSOPARENT()
    {
        return $this->hasOne(EstadoSolicitud::className(), ['ESSO_ID' => 'ESSO_PARENT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoSolicituds()
    {
        return $this->hasMany(EstadoSolicitud::className(), ['ESSO_PARENT' => 'ESSO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLSOLICITUDESs()
    {
        return $this->hasMany(TBLSOLICITUDES::className(), ['ESSO_ID' => 'ESSO_ID']);
    }
}
