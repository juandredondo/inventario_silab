<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\Ubicacion;
use app\modules\inventario\models\Simbolo;
/* @var $this yii\web\View */
/* @var $model app\models\Periodo */
/* @var $form yii\widgets\ActiveForm */
use app\assets\DatePickerAsset;
DatePickerAsset::register($this);
?>
<?php 
    // variable para imprimir el boton tambien
    $submitButton = (isset($submitButton)) ? $submitButton : true;  
?>
<div class="reactivo-form">

    <?php 
        $form = ($formId === null) ? ActiveForm::begin() : ActiveForm::begin([ "id" => $formId]); 
    ?>

    <?= $form->field($model, 'REAC_CODIGO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REAC_UNIDAD')->textInput(['maxlength' => true]) ?>

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
    <?// $form->field($model, 'ITCO_ID')->textInput() ?>
    <?// $form->field($model, 'CADU_ID')->textInput() ?>
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

    <?php if($submitButton): ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endIf; ?>

    <?php ActiveForm::end(); ?>

</div>

<?php 
        $this->registerJs("
            $(function(){

                $('input[name*=\"REAC_FECHA_VENCIMIENTO\"]').datepicker({
                    format: 'yyyy-mm-dd',
                });
            });"
        );
?>
