<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\components\widgets\DropDownWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Periodo */
/* @var $form yii\widgets\ActiveForm */
use app\assets\DatePickerAsset;
DatePickerAsset::register($this);
?>

<div class="periodo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= DropDownWidget::widget([
        'form'      => $form,
        'model'     => [
            "main"  => $model,
        ],
        'refData' => [ 
            [
                "id"     => 1, 
                "nombre" => "PRIMER SEMESTRE"
            ],
            [
                "id"     => 2, 
                "nombre" => "SEGUNDO SEMESTRE"
            ] 
        ],
        "columns"   => [ "attribute" => 'PERI_SEMESTRE', "id" => "id", "text" => "nombre" ]
    ])  ?>

    <?= $form->field($model, 'PERI_FECHA', 
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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
        $this->registerJs("
            $(function(){

                $('input[name*=\"PERI_FECHA\"]').datepicker({
                    format: 'yyyy-mm-dd',
                    minViewMode: 'years',
                    viewMode: 'years',
                    pickTime: false
                });
            });"
        );
?>
