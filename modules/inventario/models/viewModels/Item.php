<?php 
namespace app\modules\inventario\models\viewModels;

use Yii;
use yii\base\Model;

class Item extends Model
{
    public $id;
    public $nombre;
    public $observacion;
    public $marcaId;
    public $tipoItemId;

    public function rules()
    {
        return [  
            [['id',  'nombre', 'observacion'], 'required'],
            [['observacion'], 'string'],
            [['marcaId', 'tipoItemId'], 'integer'],
            [['nombre'], 'string', 'max' => 200],
        ];
    }
}
?>