<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_FUNCIONALABORATORIO".
 *
 * @property integer $FULA_ID
 * @property integer $FUNC_ID
 * @property integer $LABO_ID
 *
 * @property TBLFUNCIONARIOS $fUNC
 * @property TBLLABORATORIOS $lABO
 */
class FuncionarioLaboratorio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_FUNCIONALABORATORIO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FUNC_ID'], 'required'],
            [['FUNC_ID', 'LABO_ID'], 'integer'],
            [['FUNC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Funcionario::className(), 'targetAttribute' => ['FUNC_ID' => 'FUNC_ID']],
            [['LABO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Laboratorio::className(), 'targetAttribute' => ['LABO_ID' => 'LABO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FULA_ID' => 'Fula  ID',
            'FUNC_ID' => 'Func  ID',
            'LABO_ID' => 'Labo  ID',
        ];
    }

    public function getId() {
        return $this->FULA_ID;
    }
    public function setId($value = '') {
         $this->FULA_ID = $value;
    }

    public function getFuncionarioId() {
        return $this->FUNC_ID;
    }
    public function setFuncionarioId($value = '') {
         $this->FUNC_ID = $value;
    }

    public function getLaboratorioId() {
        return $this->LABO_ID;
    }
    public function setLaboratorioId($value = '') {
         $this->LABO_ID = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFuncionario()
    {
        return $this->hasOne(Funcionario::className(), ['FUNC_ID' => 'FUNC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaboratorio()
    {
        return $this->hasOne(Laboratorio::className(), ['LABO_ID' => 'LABO_ID']);
    }
}
