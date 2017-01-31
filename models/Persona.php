<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "TBL_PERSONAS".
 *
 * @property integer $PERS_ID
 * @property string $PERS_NOMBRE
 * @property string $PERS_IDENTIFICACION
 * @property integer $GENE_ID
 * @property integer $TIID_ID
 *
 * @property TBLCOORDINADORES[] $tBLCOORDINADORESs
 * @property TBLFUNCIONARIOS[] $tBLFUNCIONARIOSs
 * @property TBLMOVIMIENTOS[] $tBLMOVIMIENTOSs
 * @property TBLGENEROS $gENE
 * @property TBLTIPOIDENTIFICACIONES $tIID
 * @property TBLUSUARIOS[] $tBLUSUARIOSs
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_PERSONAS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PERS_NOMBRE', 'PERS_IDENTIFICACION', 'GENE_ID', 'TIID_ID'], 'required'],
            [['PERS_IDENTIFICACION', 'GENE_ID', 'TIID_ID'], 'integer'],
            [['PERS_NOMBRE'], 'string', 'max' => 100],
            [['GENE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['GENE_ID' => 'GENE_ID']],
            [['TIID_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoIdentificacion::className(), 'targetAttribute' => ['TIID_ID' => 'TIID_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PERS_ID' => 'Id Persona',
            'TIID_ID' => 'Tipo Identificacion',
            'PERS_IDENTIFICACION' => 'Identificacion',
            'PERS_NOMBRE' => 'Nombre',
            'GENE_ID' => 'Genero',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoordinadores()
    {
        return $this->hasMany(Coordinador::className(), ['PERS_ID' => 'PERS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFuncionarios()
    {
        return $this->hasMany(Funcionario::className(), ['PERS_ID' => 'PERS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientos()
    {
        return $this->hasMany(Movimiento::className(), ['PERS_ID' => 'PERS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Genero::className(), ['GENE_ID' => 'GENE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoIdentificacion()
    {
        return $this->hasOne(TipoIdentificacion::className(), ['TIID_ID' => 'TIID_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['PERS_ID' => 'PERS_ID']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($insert)
        {
           /* echo "Guardo";
            $username = substr(str_replace(' ','',strtolower($changedAttributes[ "PERS_NOMBRE" ])), 0, 5) . rand(1,20);
            $usuario = new Usuario( [ 
               "PERS_ID" => $changedAttributes[ "PERS_ID" ],
               "ROL_ID"  => Rol::getRoleByName(  Rol::Coordinador )->ROL_ID,
               "USUA_PASSWORD" => md5( 123456 ),
               "USUA_ES_ACTIVO"=>1,
               "USUA_TOKEN"=>md5(12345),
               "USUA_USUARIO" => $username
              ]);
            return $usuario->save();*/
        }

        return true;
    }
}
