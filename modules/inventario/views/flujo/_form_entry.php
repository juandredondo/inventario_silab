<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;    
use app\modules\inventario\models\TipoFlujo;

$model->TIFU_ID = TipoFlujo::Entrada;
?>

<div class="container card col-md-12">
    <div class="row">
        <div id="flow-alert-spot" class="col-md-12">
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin([ "id" => $formName, "action" => "#"  ]); ?>
                <?= $form->field($model, 'FLUJ_CANTIDAD')->textInput(["type" => "number"]) ?>

                <?= $form->field($model, 'STOC_ID')->textInput([ "type" => "hidden" ])->label(false) ?>

                <?= $form->field($model, 'TIFU_ID')->textInput([ "type" => "hidden" ])->label(false) ?>

                <input type="hidden" name="action" value="<?= Url::toRoute(["/inventario/flujo/"]) ?>">

                <div class="form-group">
                    <?= Html::submitButton('<i class="icon-bottom material-icons md-24">add_circle</i> <span id="button-text">Agregar!</span>', ['class' => 'btn btn-success', "id" => "flow-sender"]) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<?php 
    $this->registerJs("
        $(document).on('ready', function()
        {
            $('#flow-form').on('beforeSubmit', function(e){
                // - - - - Stop propagation
                    e.preventDefault();
                    e.stopPropagation();
                // - - - - It's Maui Time!
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
                    var message  = _.template( data.message )( {  excess: data.data.excess * -1 + ' items' } );
                    var result   = template({
                                        type:  isSuccess ? 'success' : 'warning',
                                        icon: {
                                            class: 'icon icon-bottom material-icons',
                                            text: (isSuccess ? 'check_circle': 'error')
                                        },
                                        title: isSuccess ? 'Enhorabuena' : 'Opps!',
                                        content: message
                                    });

                    $('#flow-alert-spot').html( result );
                    $('#flow-alert-spot .alert').fadeTo(2000, 500).slideUp(500, function(){
                        $('#flow-alert-spot .alert').slideUp(500);
                    });   
                }

                return false;
            });
        });
    ");
?>

