<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

use app\components\widgets\AlertDimissible;

/* @var $this yii\web\View */
/* @var $model app\models\Stock */

$this->title = 'Agregar item a inventario';
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="stock-create content card">

    <div data-forms>
        <div class="row">
            <div id="stock-alert-spot" class="col-md-12">
                <?php 
                    echo AlertDimissible::widget();
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" data-toggle="collapse" 
                <?=
                    Html::renderTagAttributes([ 
                        "data" => [
                            "init" => json_encode([
                                "text" => "Registrar nuevo Item & agregar",
                                "icon" => "add_circle"
                            ]),
                            "next" => json_encode([
                                "text" => "",
                                "icon" => "arrow_back"
                            ])
                        ]
                    ]) 
                ?> 
                 data-press='false'  class="btn btn-flat btn-success">
                    <i class="icon-bottom material-icons md-18">add_circle</i>
                    <span class="hidden-xs hidden-sm">Registrar nuevo Item & agregar</span>
                </a>
                <button disabled class="btn btn-flat btn-default">Buscar</button>
            </div>
        </div>
        <hr>
        <div class="row collapse in" data-form id="stock-section-form" >
            <div class="col-md-12">
                <?= $this->render('_form', [
                        'stock' => $stock,
                        /*'flujo' => $flujo,*/
                ]) ?>
            </div>
        </div>
        <div class="row collapse" data-form  id="item-section-form" data-toggle="false">
            <section class="content">
                <?= $this->render("@inventarioViews/items/create", [ "isWrapped" => false, "returnUrl" => Url::toRoute([ '' ]) ]) ?>
            </section>
        </div>
    </div>
</div>

<?php 
    $this->registerJs( "
        var stockForms          = $('[data-forms]');
        
        $('a[data-toggle=\'collapse\']').on('click', function() {
            let me      = $(this);
            let icon    = me.find('i');
            let text    = me.find('span');
            let toHide  = stockForms.find('.collapse.in');            
            let toShow  = stockForms.find('.collapse').not('.in');   

            

            toHide.collapse('hide');
            toShow.collapse('show');

            me.data( 'press', !me.data('press') );

            if( me.data('press') ) {
                icon.text( me.data( 'next' ).icon ); 
                text.text( me.data( 'next' ).text );
            }
            else {
                icon.text( me.data( 'init' ).icon ); 
                text.text( me.data( 'init' ).text );
            }
        });

    " )
?>
