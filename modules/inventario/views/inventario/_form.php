<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\widgets\DropDownWidget;

use app\models\Laboratorio;
use app\models\Periodo;
/* @var $this yii\web\View */
/* @var $model app\models\Inventario */
/* @var $form yii\widgets\ActiveForm */
    $readOnly = $this->params[ "labo.readonly" ];
    // - - - - - - - - - - - - - - - - - - - - -
    if($readOnly == null) {
        $readOnly = $model->INVE_ESSINGLETON;
    }
?>

<div class="inventario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'INVE_NOMBRE')->textInput() ?>
    <?= $form->field($model, 'INVE_ALIAS')->textInput(["readonly" => true]) ?>
    <?= $form->field($model, 'INVE_DESCRIPCION')->textArea() ?>

    <div class="form-group field-is-singleton">
            <label>
                <input type="checkbox" <?= $model->INVE_ESSINGLETON ? "checked" : "" ?> id="is-singleton" name="Inventario[INVE_ESSINGLETON]" value="<?= $model->INVE_ESSINGLETON ? 1 : 0 ?>"> 
                ES SINGLETON
            </label>
        <div class="help-block"></div>
    </div>
    
    <div class="row">
        <div class="col-md-12 ">
            <div class="well">
                <p>
                    Por defecto, Silab Ionic mantiene 5 categorias 
                    <em>(Reactivos, Materiales, Herramientas, Accesorios y Equipos)</em> y su gestion de manera automatica. 
                    <em>
                        <b>Usa esta opcion, si quieres reutilizar este inventario para varios 
                        laboratorios (No es lo mismo a un inventario compartido <a href="#" title="Conceptos">Vease documentacion</a>). Cada laboratorio, 
                        administrará sus respectivos items en stock.
                    </b>
                    </em>
                </p>
            </div>
        </div>
    </div>
    
    <?= DropDownWidget::widget([
        'form'      => $form,
        'model'     => [
            "main"  => $model,
            "ref"   => Laboratorio::className()
        ],
        "columns"   => [ "attribute" => 'LABO_ID', "id" => "id", "text" => "nombre" ],
        'options'   => [
            'disabled' => $readOnly,
            'required' => !$readOnly,
            'data' => [
                "target" => "#labo-id"
            ]
        ]
    ])  ?>
    
    <input id="labo-id" name="Inventario[LABO_ID]" type="hidden" value="<?= $model->LABO_ID ?>">
      
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

                $('select[name*=\'LABO_ID\']').on('change', function(e){
                    let me     = $(this);
                    let target = $(me.data().target);

                    target.val( me.val() );
                });

                $('#is-singleton').click(function(e){
                    let me         = $(this);
                    let laboratory = $('select[name*=\'LABO_ID\']');
                    let enabled    = me.prop('checked');
                    
                    me.val( enabled ? 1 : 0 );
                    // - - - - - - - - - - - - - - - - - - - 
                    laboratory.attr('required', !enabled );
                    laboratory.attr('disabled', enabled );
                });
            });
        ");
    ?>
