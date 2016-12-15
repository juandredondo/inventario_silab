<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_GENEROS".
 *
 * @property integer $GENE_ID
 * @property string $GENE_NOMBRE
 *
 * @property TBLPERSONAS[] $tBLPERSONASs
 */
class Genero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_GENEROS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GENE_NOMBRE'], 'required'],
            [['GENE_NOMBRE'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GENE_ID' => 'Gene  ID',
            'GENE_NOMBRE' => 'Gene  Nombre',
        ];
    }

    public function getId() {
        return $this->GENE_ID;
    }
    public function setId($value = '') {
         $this->GENE_ID = $value;
    }

    public function getNombre() {
        return $this->GENE_NOMBRE;
    }
    public function setNombre($value = '') {
         $this->GENE_NOMBRE = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasMany(Persona::className(), ['GENE_ID' => 'GENE_ID']);
    }
}
