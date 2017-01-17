<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\Ubicacion;
use app\modules\inventario\models\Unidad;
use app\modules\inventario\models\Simbolo;

use app\assets\DatePickerAsset;
DatePickerAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\ReactivoSearch */
/* @var $form yii\widgets\ActiveForm */
$item           = $model->item;
$itemConsumible = $model->parent;
?>

<div class="reactivo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <!-- <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#items" aria-expanded="true" aria-controls="collapseOne">
                    Campos Generales
                    </a>
                </h4>
            </div>
            <div id="items" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <?php 
                        require Yii::getAlias('@inventarioViews').'/items/_search-fields.php';
                    ?>
                </div>
            </div>
        </div> -->
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#reactivos" aria-expanded="true" aria-controls="collapseOne">
                        Campos especificos
                    </a>
                </h4>
            </div>
            <div id="reactivos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <?= DropDownWidget::widget([
                            'form'  => $form,
                            'model' => [
                                'main'  => $model,
                                'ref'   => Unidad::className()
                            ],
                            "columns"   => [ "id" => "UNID_ID", "text" => "UNID_NOMBRE" ]
                        ]) 
                    ?>

                    <?= $form->field($model, 'REAC_FECHA_VENCIMIENTO', 
                            [
                                "template" => '{label}<div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                {input}
                                                </div>{hint}{error}'
                            ]
                        )->textInput() 
                    ?>    

                    <?= DropDownWidget::widget([
                            'form'  => $form,
                            'model' => [
                                'main'  => $model,
                                'ref'   => Ubicacion::className()
                            ],
                            "columns"   => [ "id" => "UBIC_ID", "text" => "UBIC_CODIGO" ]
                        ]) 
                    ?>
                    <?= DropDownWidget::widget([
                            'form'  => $form,
                            'model' => [
                                'main'  => $model,
                                'ref'   => Simbolo::className()
                            ],
                            "columns"   => [ "id" => "SIMB_ID", "text" => "SIMB_NOMBRE" ]
                        ]) 
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
