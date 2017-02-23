<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\Ubicacion;
use app\modules\inventario\models\Unidad;
use app\modules\inventario\models\Simbolo;

    require Yii::getAlias("@inventarioViews").'/item-no-consumible/_form-fields.php';

    $fields[ "herramienta-HERR_CANTIDAD" ] = $form->field($model, 'HERR_CANTIDAD')->textInput();