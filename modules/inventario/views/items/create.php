<?php

use yii\helpers\Html;

use app\components\widgets\AlertDimissible;
use app\assets\InventarioAsset;
use yii\helpers\Url;

use app\modules\inventario\models as InventoryModels;

/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title                    = 'Registrar item';
$this->params['breadcrumbs'][]  = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][]  = $this->title;
$returnUrl                      = isset($returnUrl) ? $returnUrl : '';
InventarioAsset::register($this);

$this->params[ "validFormItems" ] = isset($this->params[ "validFormItems" ]) ? $this->params[ "validFormItems" ] : InventoryModels\core\TipoItem::getTypesById()[ InventoryModels\core\TipoItem::ALL ];

$isWrapped = isset($isWrapped) ? $isWrapped : true; 
?>
<?php  if($isWrapped): ?>
    <div class="items-create content card">
<?php endIf; ?>

    <div class="row">
        <div id="item-alert-spot" class="col-md-12">
            <?php 
                echo AlertDimissible::widget();
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <p>Escoja el tipo de item agregar, este desplegará un formulario valido de acuerdo al tipo.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="button-group">
                <div class="text-center">
                    <section data-item-type="<?= InventoryModels\core\TipoItem::Consumible ?>">
                        <a data-item-type="<?= InventoryModels\core\TipoItem::Reactivo ?>" class="btn btn-success btn-flat btn-app"
                            data-role='form-loader' data-target="#form-cont" data-source="<?= Url::toRoute(["/inventario/reactivo/loadform", "returnUrl" => $returnUrl ]) ?>" >
                            <i class="text-blue fa fa-hourglass-end"></i> <span class="hidden-xs">REACTIVO</span>
                        </a>
                        <a data-item-type="<?= InventoryModels\core\TipoItem::Material ?>" class="btn btn-flat btn-app" data-role='form-loader' data-target="#form-cont" data-source="<?= Url::toRoute(["/inventario/material/loadform", "returnUrl" => $returnUrl ]) ?>" >
                            <i class="text-green fa fa-eyedropper"></i> <span class="hidden-xs">MATERIAL</span>
                        </a>
                    </section>

                    <section data-item-type="<?= InventoryModels\core\TipoItem::NoConsumible ?>" >
                        <a data-item-type="<?= InventoryModels\core\TipoItem::Equipo ?>" class="btn btn-flat btn-app" data-role='form-loader' data-target="#form-cont" data-source="<?= Url::toRoute(["/inventario/equipo/loadform",  "returnUrl" => $returnUrl ]) ?>" >
                            <i class="text-red fa fa-laptop"></i> <span class="hidden-xs">EQUIPO</span>
                        </a>
                        <a data-item-type="<?= InventoryModels\core\TipoItem::Herramienta ?>" class="btn btn-flat btn-app" data-role='form-loader' data-target="#form-cont" data-source="<?= Url::toRoute(["/inventario/herramienta/loadform",  "returnUrl" => $returnUrl ]) ?>">
                            <i class="text-purple fa fa-gavel"></i> <span class="">HERRAMIENTA</span>
                        </a>
                        <a data-item-type="<?= InventoryModels\core\TipoItem::Accesorio ?>" class="btn btn-flat btn-app" data-role='form-loader' data-target="#form-cont" data-source="<?= Url::toRoute(["/inventario/accesorios/loadform",  "returnUrl" => $returnUrl ]) ?>" >
                            <i class="fa fa-laptop"></i> <span class="">ACCESORIO</span>
                        </a>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div id="form-cont" class="col-md-12">
            
        </div>
    </div>
<?php  if($isWrapped): ?>
    </div>
<?php endIf; ?>
<input type="hidden" id="valid-form-items" value="<?= $this->params[ "validFormItems" ][ "id" ] ?>" data-parent='<?= $this->params[ "validFormItems" ][ "parent" ] ?>' data-value="<?= $this->params[ "validFormItems" ][ "id" ] ?>">
<?php 
    $this->registerJs("
        //# sourceURL = items-create.js

        silab.items.init();

        var validFormItems = $('#valid-form-items').data();

        $('section[data-item-type]').each(function(){
            let me          = $(this);
            let meType      = me.data('item-type')
            let imParent    = me.has('a[data-item-type]').length > 0; 

            if( imParent && validFormItems.value != -1 )
            {
                var childs = me.find('a[data-item-type]');
                
                if( ( meType !== validFormItems.value && validFormItems.parent == '') || 
                        ( validFormItems.parent != meType && validFormItems.parent != '' ) ) {
                    me.remove();
                }
                else if( validFormItems.parent != '' )
                {
                    childs.each(function(){
                        let me = $(this);

                        if( me.data('item-type') !== validFormItems.value && validFormItems != -1 ) {
                            me.remove();
                        }
                    });
                }
            }

        })

        
    ");
?>


