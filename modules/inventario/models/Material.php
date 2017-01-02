<?php

namespace app\modules\inventario\models;

use Yii;
use app\modules\inventario\model\core\Items;
use app\modules\inventario\model\core\ItemConsumible;
/**
 * This is the model class for table "TBL_MATERIALES".
 *
 * @property integer $MATE_ID
 * @property string $MATE_MEDIDA
 * @property integer $ITCO_ID
 *
 * @property TBLITEMSCONSUMIBLES $iTCO
 */
class Material extends \app\modules\inventario\models\core\ItemBase
{
    public static function getType()
    {
        return \app\modules\inventario\models\core\TipoItem::Material;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_MATERIALES';
    }

    public static function getHierarchy()
    {
        return [
            "parent" => [
                "class"     => ItemComsumible::className(),
                "parent"    => [
                    "class" => Items::className(),
                ]
            ]
        ];
    }

    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITCO_ID'], 'required'],
            [['ITCO_ID'], 'integer'],
            [['MATE_MEDIDA'], 'string', 'max' => 45],
            [['ITCO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemConsumible::className(), 'targetAttribute' => ['ITCO_ID' => 'ITCO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MATE_ID' => 'Mate  ID',
            'MATE_MEDIDA' => 'Mate  Medida',
            'ITCO_ID' => 'Itco  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemConsumible()
    {
        return $this->hasOne(ItemConsumible::className(), ['ITCO_ID' => 'ITCO_ID']);
    }
}
