<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_EDIFICIOS".
 *
 * @property integer $EDIF_ID
 * @property string $EDIF_NOMBRE
 * @property string $EDIF_CODIGO
 *
 * @property TBLLABORATORIOS[] $tBLLABORATORIOSs
 */
class Edificio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_EDIFICIOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EDIF_NOMBRE'], 'required'],
            [['EDIF_NOMBRE'], 'string', 'max' => 100],
            [['EDIF_CODIGO'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EDIF_ID' => ' Id Edificio',
            'EDIF_NOMBRE' => 'Nombre Edificio',
            'EDIF_CODIGO' => 'Codigo Edificio',
        ];
    }

    public function getId() {
        return $this->EDIF_ID;
    }
    public function setId($value = '') {
         $this->EDIF_ID = $value;
    }

    public function getNombre() {
        return $this->EDIF_NOMBRE;
    }
    public function setNombre($value = '') {
         $this->EDIF_NOMBRE = $value;
    }

    public function getCodigo() {
        return $this->EDIF_CODIGO;
    }
    public function setCodigo($value = '') {
         $this->EDIF_CODIGO = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaboratorios()
    {
        return $this->hasMany(Laboratorio::className(), ['EDIF_ID' => 'EDIF_ID']);
    }
}
