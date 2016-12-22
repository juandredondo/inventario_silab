<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\widgets\DropDownWidget;

use app\models\Laboratorio;
use app\models\Periodo;
/* @var $this yii\web\View */
/* @var $model app\models\Inventario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'INVE_NOMBRE')->textInput() ?>
    <?= $form->field($model, 'INVE_ALIAS')->textInput(["readonly" => true]) ?>
    <?= $form->field($model, 'INVE_DESCRIPCION')->textArea() ?>
    <?= DropDownWidget::widget([
        'form'      => $form,
        'model'     => [
            "main"  => $model,
            "ref"   => Laboratorio::className()
        ],
        "columns"   => [ "attribute" => 'LABO_ID', "id" => "id", "text" => "nombre" ]
    ])  ?>

    <?= DropDownWidget::widget([
        'form'      => $form,
        'model'     => [
            "main"  => $model,
            "ref"   => Periodo::className()
        ],
        "columns"   => [ "attribute" => 'PERI_ID', "id" => "id", "text" => "alias" ]
    ])  ?>
        
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

    <?php 
        $this->registerJs("
            $(function(){

                $('input[name*=\"INVE_NOMBRE\"]').on('input', function(){
                    var me  = $(this);
                    var text = me.val();
                        text = text.replace(' ', '-').toLowerCase();
                    console.log(text);
                    $('input[name*=\"INVE_ALIAS\"]').val(text);
                });

            });
        ");
    ?>
