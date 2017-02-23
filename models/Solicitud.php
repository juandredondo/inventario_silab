<?php

namespace app\models;

use Yii;
use app\components\core\IdentificableInterface;
/**
 * This is the model class for table "TBL_SOLICITUDES".
 *
 * @property integer $SOLI_ID
 * @property string $SOLI_FECHA
 * @property string $SOLI_CODIGO
 * @property integer $TISO_ID
 * @property integer $ESSO_ID
 *
 * @property TBLDETALLESOLICITUDES[] $tBLDETALLESOLICITUDESs
 * @property TBLMOVIMIENTOS[] $tBLMOVIMIENTOSs
 * @property TBLESTADOSOLICITUD $eSSO
 * @property TBLTIPOSOLICITUD $tISO
 */
class Solicitud extends \yii\db\ActiveRecord implements IdentificableInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_SOLICITUDES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SOLI_FECHA'], 'safe'],
            [['TISO_ID', 'ESSO_ID'], 'required'],
            [['TISO_ID', 'ESSO_ID'], 'integer'],
            [['SOLI_CODIGO'], 'string', 'max' => 100],
            [['ESSO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoSolicitud::className(), 'targetAttribute' => ['ESSO_ID' => 'ESSO_ID']],
            [['TISO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoSolicitud::className(), 'targetAttribute' => ['TISO_ID' => 'TISO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SOLI_ID' => 'ID',
            'SOLI_FECHA' => 'FECHA',
            'SOLI_CODIGO' => 'CODIGO',
            'TISO_ID' => 'TIPO',
            'ESSO_ID' => 'ESTADO',
        ];
    }

    public function getId() {
        return $this->SOLI_ID;
    }
    public function setId($value = '') {
         $this->SOLI_ID = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalles()
    {
        return $this->hasMany(DetalleSolicitud::className(), ['SOLI_ID' => 'SOLI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientos()
    {
        return $this->hasMany(Movimiento::className(), ['SOLID_ID' => 'SOLI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(EstadoSolicitud::className(), ['ESSO_ID' => 'ESSO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TipoSolicitud::className(), ['TISO_ID' => 'TISO_ID']);
    }
}
