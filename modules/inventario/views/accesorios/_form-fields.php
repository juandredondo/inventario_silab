<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\Ubicacion;
use app\modules\inventario\models\Unidad;
use app\modules\inventario\models\Simbolo;

    require Yii::getAlias("@inventarioViews").'/item-no-consumible/_form-fields.php';

    $fields[ "accesorio-ACCE_SERIAL" ] = $form->field($model, 'ACCE_SERIAL')->textInput(['maxlength' => true]);
    $fields[ "accesorio-ACCE_MODELO" ] = $form->field($model, 'ACCE_MODELO')->textInput(['maxlength' => true]);