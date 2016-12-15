<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_AUDITORIALOG".
 *
 * @property integer $AULOG_ID
 * @property string $AULOG_TABLENAME
 * @property string $AULOG_FECHA
 * @property integer $USUA_ID
 * @property integer $LOTI_ID
 *
 * @property TBLLOGTIPO $lOTI
 * @property TBLUSUARIOS $uSUA
 */
class AuditLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_AUDITORIALOG';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AULOG_FECHA'], 'safe'],
            [['USUA_ID', 'LOTI_ID'], 'integer'],
            [['AULOG_TABLENAME'], 'string', 'max' => 100],
            [['LOTI_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoLog::className(), 'targetAttribute' => ['LOTI_ID' => 'LOTI_ID']],
            [['USUA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['USUA_ID' => 'USUA_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AULOG_ID' => 'Aulog  ID',
            'AULOG_TABLENAME' => 'Aulog  Tablename',
            'AULOG_FECHA' => 'Aulog  Fecha',
            'USUA_ID' => 'Usua  ID',
            'LOTI_ID' => 'Loti  ID',
        ];
    }

    public function getId()
    {
        return $this->AULOG_ID;
    }
    public function setId($value='')
    {
        $this->AULOG_ID = $value;
    }

    public function getTableName()
    {
        return $this->AULOG_TABLENAME;
    }
    public function setTableName($value='')
    {
        $this->AULOG_TABLENAME = $value;
    }

    public function getFecha()
    {
        return $this->AULOG_FECHA;
    }
    public function setFecha($value='')
    {
        $this->AULOG_FECHA = $value;
    }

    public function getUsuarioId()
    {
        return $this->USUA_ID;
    }
    public function setUsuarioId($value='')
    {
        $this->USUA_ID = $value;
    }

    public function getTipoLogId()
    {
        return $this->LOTI_ID;
    }
    public function setTipoLogId($value='')
    {
        $this->LOTI_ID = $value;
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoLog()
    {
        return $this->hasOne(TipoLog::className(), ['LOTI_ID' => 'LOTI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['USUA_ID' => 'USUA_ID']);
    }
}
