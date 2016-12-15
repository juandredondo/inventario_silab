<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_USUARIOS".
 *
 * @property integer $USUA_ID
 * @property string $USUA_USUARIO
 * @property string $USUA_PASSWORD
 * @property integer $USUA_ES_ACTIVO
 * @property integer $PERS_ID
 * @property integer $ROL_ID
 *
 * @property TBLAUDITORIALOG[] $tBLAUDITORIALOGs
 * @property TBLPERSONAS $pERS
 * @property TBLROLES $rOL
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_USUARIOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['USUA_USUARIO', 'USUA_PASSWORD', 'PERS_ID', 'ROL_ID'], 'required'],
            [['USUA_ES_ACTIVO', 'PERS_ID', 'ROL_ID'], 'integer'],
            [['USUA_USUARIO', 'USUA_PASSWORD'], 'string', 'max' => 45],
            [['PERS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['PERS_ID' => 'PERS_ID']],
            [['ROL_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['ROL_ID' => 'ROL_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'USUA_ID' => 'Usua  ID',
            'USUA_USUARIO' => 'Usua  Usuario',
            'USUA_PASSWORD' => 'Usua  Password',
            'USUA_ES_ACTIVO' => 'Usua  Es  Activo',
            'PERS_ID' => 'Pers  ID',
            'ROL_ID' => 'Rol  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditLogs()
    {
        return $this->hasMany(AuditLog::className(), ['USUA_ID' => 'USUA_ID']);
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
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['ROL_ID' => 'ROL_ID']);
    }
}
