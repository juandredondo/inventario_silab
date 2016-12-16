<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_COORDINADORES".
 *
 * @property integer $COOR_ID
 * @property integer $PERS_ID
 *
 * @property TBLPERSONAS $pERS
 * @property TBLLABORATORIOS[] $tBLLABORATORIOSs
 */
class Coordinador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_COORDINADORES';
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
            'COOR_ID' => 'ID COORDINADOR',
            'PERS_ID' => 'ID PERSONA',
            'Nombre' => Yii::t('app', 'Nombre'),
            'Identificacion' => Yii::t('app', 'Identificacion'),
        ];
    }

    public function getId() {
        return $this->COOR_ID;
    }
    public function getNombre() {
        return $this->persona->PERS_NOMBRE;
    }
        public function getIdentificacion() {
        return $this->persona->PERS_IDENTIFICACION;
    }
    public function setId($value = '') {
         $this->COOR_ID = $value;
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
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['PERS_ID' => 'PERS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaboratorios()
    {
        return $this->hasMany(Laboratorio::className(), ['COOR_ID' => 'COOR_ID']);
    }
}
