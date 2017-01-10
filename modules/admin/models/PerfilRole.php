<?php

namespace app\modules\admin\models;

use Yii;
//use app\modules\admin\models;
/**
 * This is the model class for table "TBL_PERFILESROLES".
 *
 * @property integer $PERO_ID
 * @property integer $ROL_ID
 * @property integer $PERM_ID
 * @property integer $PERO_PADRE
 *
 * @property TBLPERMISOS $pERM
 * @property TBLPERFILESROLES $pEROPADRE
 * @property TBLPERFILESROLES[] $tBLPERFILESROLESs
 * @property TBLROLES $rOL
 */
class PerfilRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_PERFILESROLES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ROL_ID', 'PERM_ID'], 'required'],
            [['ROL_ID', 'PERM_ID', 'PERO_PADRE'], 'integer'],
            [['ROL_ID', 'PERM_ID'], 'unique', 'targetAttribute' => ['ROL_ID', 'PERM_ID'], 'message' => 'Ya se ha creado un enlace entre el rol y el permiso.'],
            [['PERM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Permiso::className(), 'targetAttribute' => ['PERM_ID' => 'PERM_ID']],
            [['PERO_PADRE'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilRole::className(), 'targetAttribute' => ['PERO_PADRE' => 'PERO_ID']],
            [['ROL_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['ROL_ID' => 'ROL_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PERO_ID'       => 'Pero  ID',
            'ROL_ID'        => 'Rol  ID',
            'PERM_ID'       => 'Perm  ID',
            'PERO_PADRE'    => 'Pero  Padre',
        ];
    }

    /**
    * propiedad para proveer un alias al Active Record
    */
    public function getAlias() {
        return '('. $this->rol->ROL_NOMBRE . ') - (' . $this->permiso->alias . ')';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermiso()
    {
        return $this->hasOne(Permiso::className(), ['PERM_ID' => 'PERM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPadre()
    {
        return $this->hasOne(PerfilRole::className(), ['PERO_ID' => 'PERO_PADRE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHijos()
    {
        return $this->hasMany(PerfilRole::className(), ['PERO_PADRE' => 'PERO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['ROL_ID' => 'ROL_ID']);
    }


}
