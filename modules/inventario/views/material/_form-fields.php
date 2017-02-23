<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\Ubicacion;
use app\modules\inventario\models\Unidad;
use app\modules\inventario\models\Simbolo;

require Yii::getAlias("@inventarioViews").'/item-consumible/_form-fields.php';

$fields[ "material-MATE_MEDIDA" ] = $form->field($model, 'MATE_MEDIDA')->textInput(['maxlength' => true]);