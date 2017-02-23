<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\Ubicacion;
use app\modules\inventario\models\Unidad;
use app\modules\inventario\models\Simbolo;

    require Yii::getAlias("@inventarioViews").'/item-consumible/_form-fields.php';

    $fields[ "reactivo-REAC_CODIGO" ]   = $form->field($model, 'REAC_CODIGO')->textInput(['maxlength' => true]);
    $fields[ "reactivo-UNID_ID" ]       = DropDownWidget::widget([
            'form'  => $form,
            'model' => [
                'main'  => $model,
                'ref'   => Unidad::className()
            ],
            "columns"   => [ "id" => "UNID_ID", "text" => "UNID_NOMBRE" ]
        ]);
    $fields[ "reactivo-REAC_FECHA_VENCIMIENTO" ] = $form->field($model, 'REAC_FECHA_VENCIMIENTO', 
            [
                "template" => '{label}<div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {input}
                                </div>{hint}{error}'
            ]
        )->textInput();

    $fields[ "reactivo-UBIC_CODIGO" ] = DropDownWidget::widget([
            'form'  => $form,
            'model' => [
                'main'  => $model,
                'ref'   => Ubicacion::className()
            ],
            "columns"   => [ "id" => "UBIC_ID", "text" => "UBIC_CODIGO" ]
        ]);

    $fields[ "reactivo-SIMB_ID" ] = DropDownWidget::widget([
            'form'  => $form,
            'model' => [
                'main'  => $model,
                'ref'   => Simbolo::className()
            ],
            "columns"   => [ "id" => "SIMB_ID", "text" => "SIMB_NOMBRE" ],
        ]) 
?>