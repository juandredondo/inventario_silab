<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_LABORATORIOS".
 *
 * @property integer $LABO_ID
 * @property string $LABO_NOMBRE
 * @property integer $LABO_NIVEL
 * @property integer $EDIF_ID
 * @property integer $COOR_ID
 * @property integer $TILA_ID
 *
 * @property TBLFUNCIONALABORATORIO[] $tBLFUNCIONALABORATORIOs
 * @property TBLINVENTARIOS[] $tBLINVENTARIOSs
 * @property TBLTIPOLABORATORIOS $tILA
 * @property TBLCOORDINADORES $cOOR
 * @property TBLEDIFICIOS $eDIF
 */
class Laboratorio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_LABORATORIOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LABO_NOMBRE', 'EDIF_ID', 'COOR_ID', 'TILA_ID'], 'required'],
            [['LABO_NIVEL', 'EDIF_ID', 'COOR_ID', 'TILA_ID'], 'integer'],
            [['LABO_NOMBRE'], 'string', 'max' => 100],
            [['TILA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoLaboratorio::className(), 'targetAttribute' => ['TILA_ID' => 'TILA_ID']],
            [['COOR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Coordinador::className(), 'targetAttribute' => ['COOR_ID' => 'COOR_ID']],
            [['EDIF_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Edificio::className(), 'targetAttribute' => ['EDIF_ID' => 'EDIF_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LABO_ID' => 'Labo  ID',
            'LABO_NOMBRE' => 'Labo  Nombre',
            'LABO_NIVEL' => 'Labo  Nivel',
            'EDIF_ID' => 'Edif  ID',
            'COOR_ID' => 'Coor  ID',
            'TILA_ID' => 'Tila  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFuncionarios()
    {
        return $this->hasMany(Funcionario::className(), ['FUNC_ID' => 'FUNC_ID'])->viaTable('TBL_FUNCIONALABORATORIO', ['LABO_ID' => 'LABO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['LABO_ID' => 'LABO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoLaboratorio()
    {
        return $this->hasOne(TipoLaboratorio::className(), ['TILA_ID' => 'TILA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoordinador()
    {
        return $this->hasOne(Coordinador::className(), ['COOR_ID' => 'COOR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEdificio()
    {
        return $this->hasOne(Edificio::className(), ['EDIF_ID' => 'EDIF_ID']);
    }
}
