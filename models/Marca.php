<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_MARCAS".
 *
 * @property integer $MARC_ID
 * @property string $MARC_NOMBRE
 *
 * @property TBLITEMS[] $tBLITEMSs
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_MARCAS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MARC_NOMBRE'], 'required'],
            [['MARC_NOMBRE'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MARC_ID' => 'Marc  ID',
            'MARC_NOMBRE' => 'Marc  Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['MARC_ID' => 'MARC_ID']);
    }
}
