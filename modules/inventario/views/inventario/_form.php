<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;

use app\modules\inventario\models as InventoryModels;
use app\models\Laboratorio;
use app\models\Periodo;
/* @var $this yii\web\View */
/* @var $model app\models\Inventario */
/* @var $form yii\widgets\ActiveForm */
    $readOnly = isset($this->params[ "labo.readonly" ]) ? $this->params[ "labo.readonly" ] : false;
    // - - - - - - - - - - - - - - - - - - - - -
    if($readOnly == null) {
        $readOnly = $model->INVE_ESSINGLETON;
    }

    function getIconsItem()
    {
        return [
            InventoryModels\core\TipoItem::Consumible   => [
                "icon" => "fa fa-spinner",
                "color" => "danger"
            ],
            InventoryModels\core\TipoItem::NoConsumible => [ "icon" => "fa fa-circle-o-notch", "color" => "danger" ],
            InventoryModels\core\TipoItem::Reactivo     => ["icon" => "fa fa-hourglass-end"],
            InventoryModels\core\TipoItem::Reactivo     => ["icon" => "fa fa-hourglass-end"],
            InventoryModels\core\TipoItem::Reactivo     => ["icon" => "fa fa-hourglass-end"],
            InventoryModels\core\TipoItem::Material     => ["icon" => "fa fa-eyedropper"],
            InventoryModels\core\TipoItem::Accesorio    => ["icon" => "fa fa-briefcase"],
            InventoryModels\core\TipoItem::Equipo       => ["icon" => "fa fa-laptop"],
            InventoryModels\core\TipoItem::Herramienta  => ["icon" => "fa fa-gavel"],
            InventoryModels\core\TipoItem::ALL          => ["icon" => "fa fa-minus-square", "color" => "success"]
        ];
    }

    function getTypeItems()
    {
        $types = [
            [ "id" => -1, "name" => "TODOS"  ],
        ];

        $types = array_merge( $types, InventoryModels\core\TipoItem::getTypes() );
        return $types; 
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
        "columns"   => [ "attribute" => 'LABO_ID', "id" => "LABO_ID", "text" => "LABO_NOMBRE" ],
        'options'   => [
            'disabled' => $readOnly,
            'required' => !$readOnly,
            'data' => [
                "target" => "#labo-id"
            ]
        ]
    ])  ?>

    <div class="well">
        <div class="row">
            <label class="contro-label">
                <?= $model->getAttributeLabel('TIIT_ID' ) ?>
            </label>
        </div>

        <div class="button-group">
            <?php 
                if(!isset($model->TIIT_ID))
                    $model->TIIT_ID = InventoryModels\core\TipoItem::ALL;
            ?>
            <?= $form->field($model, 'TIIT_ID')
                    ->radioList(
                        ArrayHelper::map( getTypeItems(), "id", "name" ),
                        [
                            "class" => "text-center",
                            "data" => [
                                "toggle" => "buttons"
                            ],
                            "item" => function($index, $label, $name, $checked, $value)
                            {
                                $icons      = getIconsItem();
                                $isParent   = $value == InventoryModels\core\TipoItem::Consumible || $value == InventoryModels\core\TipoItem::NoConsumible;
                                $input      = "<input " . ( $checked ? "checked" : "" ) . " type='radio' value='" . $value . "' name='" . $name . "'>";
                                $labelText  = "<i class='" . $icons[ $value ][ "icon" ] . "'></i><span class='hidden-xs'> " . $label . "</span>";                            
                                
                                if($value == -1)
                                {
                                    return "<label style='margin-right: 15px' class='" . ( $checked ? "active" : "" ) . " btn btn-danger' >" . $input . $labelText . "</label>";
                                }

                                return "<label class='" . ( $checked ? "active" : "" ) . " btn btn-" . ( $isParent ? "warning" : "default" ) . "' >" . $input . $labelText . "</label>";
                            }
                        ]
                    )->label(false) ?>
        </div>
        <p>Limitar este inventario a uno de estos tipo items</p>
    </div>

    
    
    <input id="labo-id" name="Inventario[LABO_ID]" type="hidden" value="<?= $model->LABO_ID ?>">
      
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'REGISTRAR' : 'ACTUALIZAR', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton( 'RESET', ['class' => 'btn btn-default']) ?>
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
