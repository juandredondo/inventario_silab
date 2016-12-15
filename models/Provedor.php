<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_PROVEDORES".
 *
 * @property integer $PROV_ID
 * @property string $PROV_NOMBRE
 * @property string $PROV_NIT
 *
 * @property TBLFACTURAS[] $tBLFACTURASs
 */
class Provedor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_PROVEDORES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROV_NOMBRE'], 'required'],
            [['PROV_NOMBRE'], 'string', 'max' => 100],
            [['PROV_NIT'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROV_ID' => 'Prov  ID',
            'PROV_NOMBRE' => 'Prov  Nombre',
            'PROV_NIT' => 'Prov  Nit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['PROV_ID' => 'PROV_ID']);
    }
}
