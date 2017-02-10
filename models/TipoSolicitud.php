<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_TIPOSOLICITUD".
 *
 * @property integer $TISO_ID
 * @property string $TISO_NOMBRE
 *
 * @property TBLSOLICITUDES[] $tBLSOLICITUDESs
 */
class TipoSolicitud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_TIPOSOLICITUD';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TISO_NOMBRE'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TISO_ID' => 'Tiso  ID',
            'TISO_NOMBRE' => 'Tiso  Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLSOLICITUDESs()
    {
        return $this->hasMany(TBLSOLICITUDES::className(), ['TISO_ID' => 'TISO_ID']);
    }
}
