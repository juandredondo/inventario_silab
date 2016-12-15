<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_TIPOIDENTIFICACIONES".
 *
 * @property integer $TIID_ID
 * @property string $TIID_NOMBRE
 *
 * @property TBLPERSONAS[] $tBLPERSONASs
 */
class TipoIdentificacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_TIPOIDENTIFICACIONES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TIID_NOMBRE'], 'required'],
            [['TIID_NOMBRE'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TIID_ID' => 'Tiid  ID',
            'TIID_NOMBRE' => 'Tiid  Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['TIID_ID' => 'TIID_ID']);
    }
}
