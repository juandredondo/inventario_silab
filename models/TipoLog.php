<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_LOGTIPO".
 *
 * @property integer $LOTI_ID
 * @property integer $LOTI_DESCRIPCION
 *
 * @property TBLAUDITORIALOG[] $tBLAUDITORIALOGs
 */
class TipoLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_LOGTIPO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LOTI_DESCRIPCION'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LOTI_ID' => 'Loti  ID',
            'LOTI_DESCRIPCION' => 'Loti  Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditLogs()
    {
        return $this->hasMany(AuditLog::className(), ['LOTI_ID' => 'LOTI_ID']);
    }
}
