<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_FUNCIONARIOS".
 *
 * @property integer $FUNC_ID
 * @property integer $PERS_ID
 *
 * @property TBLFUNCIONALABORATORIO[] $tBLFUNCIONALABORATORIOs
 * @property TBLPERSONAS $pERS
 */
class Funcionario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_FUNCIONARIOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PERS_ID'], 'required'],
            [['PERS_ID'], 'integer'],
            [['PERS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['PERS_ID' => 'PERS_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FUNC_ID' => 'Func  ID',
            'PERS_ID' => 'Pers  ID',
        ];
    }

    public function getId() {
        return $this->FUNC_ID;
    }
    public function setId($value = '') {
         $this->FUNC_ID = $value;
    }

    public function getPersonaId() {
        return $this->PERS_ID;
    }
    public function setPersonaId($value = '') {
         $this->PERS_ID = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaboratoriosAsignados()
    {
        return $this->hasMany(Laboratorio::className(), ['LABO_ID' => 'LABO_ID'])->viaTable('TBL_FUNCIONALABORATORIO', ['FUNC_ID' => 'FUNC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['PERS_ID' => 'PERS_ID']);
    }
}
