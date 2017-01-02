<?php

namespace app\modules\inventario\models\core;

use Yii;
use app\components\core\IdentificableInterface;
use app\components\core\LoadableActiveRecord;

/**
 * This is the model class for table "TBL_ITEMSCONSUMIBLES".
 *
 * @property integer $ITCO_ID
 * @property integer $ITEM_ID
 * @property integer $estadoConsumible_id
 *
 * @property TBLESTADOSCONSUMIBLE $estadoConsumible
 * @property TBLITEMS $iTEM
 * @property TBLMATERIALES[] $tBLMATERIALESs
 * @property TBLREACTIVOS[] $tBLREACTIVOSs
 */
class ItemConsumible extends LoadableActiveRecord implements IdentificableInterface 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_ITEMSCONSUMIBLES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_ID', 'ESCO_ID'], 'required'],
            [['ITEM_ID', 'ESCO_ID'], 'integer'],
            [['ESCO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoConsumible::className(), 'targetAttribute' => ['ESCO_ID' => 'ESCO_ID']],
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITCO_ID' => 'Itco  ID',
            'ITEM_ID' => 'Item  ID',
            'ESCO_ID' => 'Estado Consumible ID',
        ];
    }

    public function getId() 
    {
        return $this->ITCO_ID;
    }
    public function setId($value = 0) 
    {
         $this->ITCO_ID = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoConsumible()
    {
        return $this->hasOne(EstadoConsumible::className(), ['ESCO_ID' => 'ESCO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMateriales()
    {
        return $this->hasMany(Material::className(), ['ITCO_ID' => 'ITCO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReactivos()
    {
        return $this->hasMany(Reactivo::className(), ['ITCO_ID' => 'ITCO_ID']);
    }
}
