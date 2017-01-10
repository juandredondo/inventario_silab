<?php

namespace app\models;

use Yii;
use app\modules\inventario\models\Inventario;
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
            [['LABO_NOMBRE', 'EDIF_ID', 'COOR_ID', 'TILA_ID','LABO_NIVEL'], 'required'],
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
            'LABO_ID' => 'Id Laboratorio',
            'LABO_NOMBRE' => 'Nombre Laboratorio',
            'LABO_NIVEL' => 'Nivel Laboratorio',
            'TILA_ID' => 'Tipo Laboratorio',
            'COOR_ID' => 'Coordinador',
            'EDIF_ID' => 'Edificio',
        ];
    }

    public function getId() {
        return $this->LABO_ID;
    }
    public function setId($value = '') {
         $this->LABO_ID = $value;
    }

    public function getNombre() {
        return $this->LABO_NOMBRE;
    }
    public function setNombre($value = '') {
         $this->LABO_NOMBRE = $value;
    }

    public function getNivel() {
        return $this->LABO_NIVEL;
    }
    public function setNivel($value = '') {
         $this->LABO_NIVEL = $value;
    }

    public function getTipoLaboratorioId() {
        return $this->TILA_ID;
    }
    public function setTipoLaboratorioId($value = '') {
         $this->TILA_ID = $value;
    }

    public function getCoordinadorId() {
        return $this->COOR_ID;
    }
    public function setCoordinadorId($value = '') {
         $this->COOR_ID = $value;
    }

    public function getEdificioId() {
        return $this->EDIF_ID;
    }
    public function setEdificioId($value = '') {
         $this->EDIF_ID = $value;
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
    public function getTipolaboratorio()
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

    public static function getInventariosById($id)
    {
        return  Inventario::find()
                ->where(["LABO_ID" => $id])
                ->all();
    }

    public static function getInventariosByNombre($nombre)
    {
        $laboratorio = static::getByNombre($nombre);
        if($laboratorio !== null)
            return static::getInventariosById($laboratorio->id);
        else 
            [];
    }

    public static function getByNombre($nombre)
    {
        $laboratorio = static::find()->where(['like', "LABO_NOMBRE", [$nombre]])->one();
        return $laboratorio;
    }
}
