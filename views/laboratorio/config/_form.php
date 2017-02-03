<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LaboratorioConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="laboratorio-config-form">

    <?php $form = ActiveForm::begin([ "id" => "laboratory-config-form", "action" => [ 'save-config', "id" => $model->LABO_ID ] ]); ?>

    <p>Stock minimo y maximo para cada item.</p>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'LACO_STOCKMIN')->textInput([ "type" => "number" ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'LACO_STOCKMAX')->textInput([ "type" => "number" ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'LABO_ID')->textInput(
        [
            "type" => "hidden", 'readonly' => false
        ]
        )->label(false) 
    ?>

    <?= $form->field($model, 'PERI_ID')->textInput(
        [
            "type" => "hidden", 'readonly' => false 
        ]
        )->label(false) 
    ?>

    <?// $form->field($model, 'TIIT_ID')->textInput() ?>

    <?= $form->field($model, 'LACO_MAXINVENTARIOS')->textInput([ "type" => "number" ]) ?>

    <?php //$form->field($model, 'LACO_EXTRADATA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton("Guardar cambios", ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php 
        $this->registerJs(" 
            $('#laboratory-config-form').on('beforeSubmit', configSaveHandler);

            function configSaveHandler(e)
            { 
                // - - - - Stop propagation
                    e.preventDefault();
                    e.stopPropagation();
                // - - - - A great power comes with a great responsability!
                
                let form = $(this);
                
                $.post(form.attr('action'), form.serialize(), success);

                function success(data)
                {
                    var isSuccess = data.status == 0;
                    var alertHtml = silab.helpers.getTemplate({
                                        target: '#alert-dimissible',
                                        isGrouped: true
                                    });
                    
                    var template = _.template( alertHtml );
                    var message  = _.template( data.message )({  });
                    var result   = template({
                                        type:  isSuccess ? 'success' : 'warning',
                                        icon: {
                                            class: 'icon icon-bottom material-icons',
                                            text: (isSuccess ? 'check_circle': 'error')
                                        },
                                        title: isSuccess ? 'Todo monocuco!' : 'Ñelda!',
                                        content: message
                                    });

                    $('#laboratory-alert-spot').html( result );
                    $('#laboratory-alert-spot .alert').fadeTo(2000, 500).slideUp(500, function(){
                        $('#laboratory-alert-spot .alert').slideUp(500);
                    });   
                }
                
                return false;
            }
        ");
    ?>
</div>
