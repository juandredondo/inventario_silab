<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_ROLES".
 *
 * @property integer $ROL_ID
 * @property string $ROL_NOMBRE
 * @property integer $ROL_ORDEN
 *
 * @property TBLPERFILESROLES[] $tBLPERFILESROLESs
 * @property TBLPERMISOS[] $pERMs
 * @property TBLUSUARIOS[] $tBLUSUARIOSs
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_ROLES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ROL_NOMBRE', 'ROL_ORDEN'], 'required'],
            [['ROL_ORDEN'], 'integer'],
            [['ROL_NOMBRE'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ROL_ID' => 'Rol  ID',
            'ROL_NOMBRE' => 'Rol  Nombre',
            'ROL_ORDEN' => 'Rol  Orden',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerfilesRoles()
    {
        return $this->hasMany(PerfilRole::className(), ['ROL_ID' => 'ROL_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermisos()
    {
        return $this->hasMany(Permiso::className(), ['PERM_ID' => 'PERM_ID'])->viaTable('TBL_PERFILESROLES', ['ROL_ID' => 'ROL_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['ROL_ID' => 'ROL_ID']);
    }
}
