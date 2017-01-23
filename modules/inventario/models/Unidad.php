<?php

namespace app\modules\inventario\models;

use Yii;
use app\modules\inventario\models\core\Items;
use app\modules\inventario\models\core\TipoItem;
use app\modules\inventario\models\Reactivo;
/**
 * This is the model class for table "TBL_UNIDADES".
 *
 * @property integer $UNID_ID
 * @property string $UNID_NOMBRE
 * @property string $UNID_DESCRIPCION
 */
class Unidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_UNIDADES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UNID_NOMBRE'], 'required'],
            [['UNID_NOMBRE', 'UNID_DESCRIPCION'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UNID_ID' => 'Unid  ID',
            'UNID_NOMBRE' => 'Unid  Nombre',
            'UNID_DESCRIPCION' => 'Unid  Descripcion',
        ];
    }

    public static function getItemUnity($id)
    {
        $isReactive = Items::findOne($id)->TIIT_ID == TipoItem::Reactivo;
        
        if($isReactive) {
            $reactive = Reactivo::getByItemId($id);
            
            if($reactive !== null) {
                $unit = $reactive->unidad;
                return isset($unit) ? $unit->UNID_NOMBRE : "";
            }
        }
        
        return "UND";
    }
}
