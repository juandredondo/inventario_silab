<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "TBL_PERMISOS".
 *
 * @property integer $PERM_ID
 * @property string $PERM_ACCION
 * @property string $PERM_CONTROLADOR
 * @property string $PERM_MODULO
 * @property integer $PERM_PADRE
 *
 * @property TBLPERFILESROLES[] $tBLPERFILESROLESs
 * @property TBLROLES[] $rOLs
 * @property TBLPERMISOS $pERMPADRE
 * @property TBLPERMISOS[] $tBLPERMISOSs
 */
class Permiso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_PERMISOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PERM_PADRE'], 'integer'],
            [['PERM_ACCION', 'PERM_CONTROLADOR', 'PERM_MODULO'], 'string', 'max' => 45],
            [['PERM_PADRE'], 'exist', 'skipOnError' => true, 'targetClass' => Permiso::className(), 'targetAttribute' => ['PERM_PADRE' => 'PERM_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PERM_ID' => 'Perm  ID',
            'PERM_ACCION' => 'Perm  Accion',
            'PERM_CONTROLADOR' => 'Perm  Controlador',
            'PERM_MODULO' => 'Perm  Modulo',
            'PERM_PADRE' => 'Perm  Padre',
        ];
    }


    public function getAlias() {
        $modulo         = ($this->PERM_MODULO !== null )        ? ($this->PERM_MODULO . "/")        : "";
        $controlador    = ($this->PERM_CONTROLADOR !== null )   ? ($this->PERM_CONTROLADOR . "/")   : "";

        return  $modulo . $controlador . $this->PERM_ACCION;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerfilesRoles()
    {
        return $this->hasMany(PerfilRole::className(), ['PERM_ID' => 'PERM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Rol::className(), ['ROL_ID' => 'ROL_ID'])->viaTable('TBL_PERFILESROLES', ['PERM_ID' => 'PERM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPadre()
    {
        return $this->hasOne(Permiso::className(), ['PERM_ID' => 'PERM_PADRE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHijos()
    {
        return $this->hasMany(Permiso::className(), ['PERM_PADRE' => 'PERM_ID']);
    }
}
