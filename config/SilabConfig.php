<?php

namespace app\config;

use Yii;

/**
 * This is the model class for table "TBL_SILABCONFIGS".
 *
 * @property integer $SILAB_ID
 * @property double $SILAB_VERSION
 * @property double $SILAB_PATH
 * @property string $SILAB_NAME
 * @property double $SILAB_STOCK_MIN
 * @property double $SILAB_STOCK_MAX
 * @property integer $SILAB_MAX_INVENTARIOS
 * @property string $createdAt
 */
class SilabConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_SILABCONFIGS';
    }

    private static $_config = null;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SILAB_VERSION', 'SILAB_PATH', 'SILAB_STOCK_MIN', 'SILAB_STOCK_MAX'], 'number'],
            [['SILAB_NAME'], 'required'],
            [['SILAB_MAX_INVENTARIOS'], 'integer'],
            [['createdAt'], 'safe'],
            [['SILAB_NAME'], 'string', 'max' => 45],
            [['SILAB_VERSION'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SILAB_ID' => 'Silab  ID',
            'SILAB_VERSION' => 'Silab  Version',
            'SILAB_PATH' => 'Silab  Path',
            'SILAB_NAME' => 'Silab  Name',
            'SILAB_STOCK_MIN' => 'Silab  Stock  Min',
            'SILAB_STOCK_MAX' => 'Silab  Stock  Max',
            'SILAB_MAX_INVENTARIOS' => 'Silab  Max  Inventarios',
            'createdAt' => 'Created At',
        ];
    }

    public static function getCurrentConfig()
    {
        if(!isset(static::$_config))
        {
            $config = static::find()->orderBy([ "SILAB_ID" => SORT_DESC ])->one();

            $config = isset($config) ? $config : new SilabConfig([
                "SILAB_NAME"            => "SILAB IONIC",
                "SILAB_VERSION"         => 1.0,
                "SILAB_STOCK_MIN"       => 45,
                "SILAB_STOCK_MAX"       => 2000,
                "SILAB_MAX_INVENTARIOS" => 5
            ]);

            static::$_config = $config;
        }

        return static::$_config;
    }
}
