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
            [['ESSO_NOMBRE'], 'string'],
            [['ESSO_ORDEN', 'ESSO_PARENT'], 'integer'],
            [['ESSO_PARENT'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoSolicitud::className(), 'targetAttribute' => ['ESSO_PARENT' => 'ESSO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ESSO_ID' => 'ID',
            'ESSO_NOMBRE' => 'ESTADO',
            'ESSO_ORDEN' => 'ORDEN',
            'ESSO_PARENT' => 'PADRE',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(EstadoSolicitud::className(), ['ESSO_ID' => 'ESSO_PARENT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHijos()
    {
        return $this->hasMany(EstadoSolicitud::className(), ['ESSO_PARENT' => 'ESSO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudes()
    {
        return $this->hasMany(TBLSOLICITUDES::className(), ['ESSO_ID' => 'ESSO_ID']);
    }

    public static function getInitState()
    {
        $minOrder   = static::find()->min('ESSO_ORDEN');
        $state      = static::find()->where( [ "ESSO_ORDEN" => $minOrder ] )->one();

        if ( !isset($state) ) {
           $state = new EstadoSolicitud([             
                "ESSO_NOMBRE" => "PENDIENTE",
                "ESSO_ORDEN"  => 0,
                "ESSO_PARENT"  => null
            ]);

           $state->save(); 
        }

        return $state;
    }
}
