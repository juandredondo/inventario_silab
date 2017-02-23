<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\components\core\ExpirableInterface;
use app\components\widgets\DropDownWidget;

use app\modules\inventario\models\core\Items;
use app\modules\inventario\models as InventoryModels;
use app\models\Periodo;
use app\models\Laboratorio;

use app\assets\DatePickerAsset;
DatePickerAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Stock */
/* @var $form yii\widgets\ActiveForm */
$stock->INVE_ID = Yii::$app->request->get('id');

// Items validos para el inventario
$itemValidType  = $stock->inventario->TIIT_ID;
// - - - - - - - - - - - - - - - - - - - - - - 
$items          = Items::getItemsNotInStock( true )->where( [ "TIIT_ID" => $itemValidType ] )->all();
// - - - - - - - - - - - - - - - - - - - - - - 
$isExpirable    = $stock->item->isExpirable;

$this->params[ "validFormItems" ] = InventoryModels\core\TipoItem::getTypesById( )[ 
    isset($itemValidType) ? $itemValidType : InventoryModels\core\TipoItem::ALL  
];

function generateItemsList($model, $items)
{
    $select     = "<select {attributes}>{options}</select>";
    $attributes = [ 
            "name"      => Html::getInputName( $model, 'ITEM_ID' ), 
            "class"     => [ "form-control", "select"  ],
            "required"  => true
    ];

    $options    = ["<option></option>"];
        foreach($items as $item)
        {
            $info = $item->traverseInfo();
            $optionsAttr = [
                "value" => $item->id,
                "data" => [
                    "expirable"     => $item->isExpirable ? "true" : "false",
                    "consumible"    => $info->isConsumible ? "true" : "false", 
                    "subClass"      => Json::encode( $info->parent )
                ]
            ];
            
            if($info instanceof ExpirableInterface)
                $optionsAttr[ "data" ][ "expiration" ] = $info->expirationDate;

            $option = "<option {options}>{text}</option>";
            $option = str_replace("{options}", Html::renderTagAttributes( $optionsAttr ), $option );
            $option = str_replace("{text}", $item->ITEM_NOMBRE, $option );

            array_push($options, $option);
        }

    $select = str_replace( "{attributes}", Html::renderTagAttributes($attributes), $select );
    $select = str_replace( "{options}", implode ( "" , $options ), $select );

    echo $select;
}
?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= generateItemsList($stock, $items)  ?>
    
    <input type="hidden" name="is-expirable" id="is-expirable" />
 	
     <?= $form->field($stock, 'INVE_ID')->textInput(
 		['type'=>'hidden','readonly' => false ])->label(false) ?>

    <?php 
        if($stock->inventario->isSingleton):
    ?>
        <?= DropDownWidget::widget([
            "form"  =>  $form,
            "model" =>  [
                "main"  => $stock,
                "ref"   => Laboratorio::className()
            ],
            "columns"   => [
                "id"    =>  "LABO_ID",
                "text"  =>  "LABO_NOMBRE"
            ]
        ]); ?>
    <?php endIf; ?>
         
    <?= $form->field($stock, 'STOC_CANTIDAD')->textInput(['type' => 'number', "required" => true]) ?>
    <div class="row" style="font-size: 18px" >
        <div class="col-md-2 col-xs-4">
            <p>
                 <span class="label label-danger full-block">MINIMO <span id="min-amount" ></span> </span>
                 <input type="hidden" name="<?= Html::getInputName( $stock, 'STOC_MIN' ) ?>" id="stock-min" />
            </p>
        </div>
        <div class="col-md-2 col-xs-4 pull-right">
            <p>
                 <span class="label label-warning full-block">MAXIMO <span id="max-amount" ></span></span>
                 <input type="hidden" name="<?= Html::getInputName( $stock, 'STOC_MAX' ) ?>" id="stock-max" />
            </p>
        </div>
    </div>

    <section id="flow-expirable" class="<?= $isExpirable ? "" : "hidden" ?>">
        <?
            $expirableStock = new InventoryModels\StockExpirado ();

            echo $form->field($expirableStock, 'STVE_FECHAVENCIMIENTO', 
                [
                    "template" => '{label}<div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {input}
                                    </div>{hint}{error}'
                ]
            )->textInput([ "aria-required" => false, "required" => false, "id" => "entry-expiration-date" ]);

        ?>   
    </section>
    <input type="hidden" id="real-expiration-date" name="StockExpirado[FECHAVENCIMIENTO]">
    
    <div class="checkbox">
        <label>
        <input  type="checkbox"
                id="stock-manual-period"
                data-href="#collapse-period"
        > Agregar periodo manual
        </label>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>
                Por defecto, Silab Ionic mantiene la gestion de los periodos de cada inventario de manera automatica. 
                <em><b>Usa esta opcion si, quieres agregar manualmente el periodo de este stock para el item </b>
                <span class="label label-default" id="item-name"></span></em>
            </p>
        </div>
    </div>
    <input type="hidden" value="auto" name="manual-period">

    <div class="collapse" id="collapse-period">
        <div class="well">
            <?php 
                if($stock->isNewRecord)
                    $stock->PERI_ID = 1;
            ?>
            <?= $form->field($stock, 'PERI_ID')->dropDownList(      
                ArrayHelper::map(Periodo::find()->all(), 'PERI_ID', 'alias'),
                ['prompt'=>'-Seleccione un periodo-', "required" => false])
            ?>
        </div>
    </div>
   

    <div class="form-group">
        <?= Html::submitButton($stock->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $stock->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
    $this->registerJs("
        $(document).on('ready', main);

        function processNewItem(data)
        {
            if(typeof data.model !== 'undefined')
            {
                // 1. add the new item to list and close the modal
                var select = $('select[name*=\'ITEM_ID\']');
                
                if(data.model.item.ITEM_ID)
                {
                    silab.helpers.appendOption({
                        select: select,
                        selected: true,
                        data: {
                            'expirable': data.model.isExpirable,
                            'consumible': data.model.isConsumible,
                            'subClass': JSON.stringify( data.model.parent ),
                            'expiration': data.model.FECHA_VENCIMIENTO
                            },
                        text: data.model.item.ITEM_NOMBRE,
                        value: data.model.item.ITEM_ID
                    });
                }

                console.log(data.model);
            }
        }

        function main()
        {

            // - - - Initialize Datepicker Plugin
            $('input[name*=\"STVE_FECHAVENCIMIENTO\"]').datepicker({
                format: 'yyyy-mm-dd',
            });

            $('#stock-manual-period').click(function(e){
                let me = $('input[name=\'manual-period\']');
                
                me.val( me.val() === 'auto' ? 'manual' : 'auto');
                
                $('#collapse-period').collapse('toggle');
            });

            $('select[name*=\'ITEM_ID\']').change(function(){
                let me          = $(this).children(':selected');
                let myData      = me.data();
                let text        = me.text();
                let isExpirable = myData.expirable;

                $('#item-name').text( text === '' ? 'X' : text );
                
                showExpirationDateAndMinMax(me);
            });

            function showExpirationDateAndMinMax(selected)
            {
                var lS        = Storages.localStorage;
                var selected  = selected || getSelectedData();
                var sdata     = selected.data();

                var expirable       = sdata.expirable;
                var expirationDate  = sdata.expiration;

                var dateField  = $('input[name*=\"STVE_FECHAVENCIMIENTO\"]');
                var realDField = $('#real-expiration-date');

                expirable      = sdata.expirable ? true : false;

                $('#flow-expirable').removeClass( expirable  ? 'hidden' : '' )
                                    .addClass   ( !expirable ? 'hidden' : '' )
                $('#entry-expiration-date').attr('required', expirable ? true : false );
                // - - - Set the expirable input for server procesing - - -
                $('#is-expirable').val(expirable)

                // - - - save current expirable
                lS.set('currentExpirable', expirable);

                if(!_.isUndefined( expirationDate )) {
                    dateField.val( expirationDate ).attr('disabled', true);
                    realDField.val( expirationDate );
                }
                else {
                    dateField.removeAttr('disabled', true).val('');
                    realDField.val( '' );
                }

                setMinAndMax(selected);
            }

            function getSelectedData()
            {
                var me = $('[name=\'Stock[ITEM_ID]\']').find(':selected')
                return me;
            }

            function setMinAndMax(selected)
            {
                let myData              = selected.data();
                let amountField         = $('[name*=\'CANTIDAD\']');
                let limitNoConsumible   = silab.consts.MAX_NOT_CONSUMIBLE;
                
                if(myData.consumible == 1)
                {
                    // - - - Min and Max values
                    $('#min-amount').text( myData.subclass.ITCO_MIN ).parent().show();
                    $('#stock-min').val( myData.subclass.ITCO_MIN );
                    // - - - - - - - - - - - - - - - - - - - - - - - -
                    $('#max-amount').text( myData.subclass.ITCO_MAX ).parent().show();
                    $('#stock-max').val( myData.subclass.ITCO_MAX );

                    amountField.attr( 'min', myData.subclass.ITCO_MIN )
                    amountField.attr( 'max', myData.subclass.ITCO_MAX );
                }
                else if(myData.consumible == 0)
                {
                    // - - - Drop min and max values
                    $('#min-amount').text( limitNoConsumible );
                    $('#stock-min').val( limitNoConsumible );
                    // - - - - - - - - - - - - - - - - - - - - - - - -
                    $('#max-amount').text( limitNoConsumible );
                    $('#stock-max').val( limitNoConsumible );

                    amountField.attr( 'min', limitNoConsumible );
                    amountField.attr( 'max', limitNoConsumible );
                    amountField.val( limitNoConsumible );
                }
            }

            showExpirationDateAndMinMax();

            window.itemFormCallback = processNewItem;
        }
    ");
?>
