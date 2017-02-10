<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\modules\inventario\models\core\Items;
use app\modules\inventario\models as InventoryModels;
use app\models\Periodo;

use app\assets\DatePickerAsset;
DatePickerAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Stock */
/* @var $form yii\widgets\ActiveForm */
$items          = Items::find()->all();
$isExpirable    = $stock->item->isExpirable;

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
            $optionsAttr = [
                "value" => $item->id,
                "data" => [
                    "expirable" => $item->isExpirable,
                    "subClass"  => Json::encode( $item->traverseInfo()->parent )
                ]
            ];
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
 		['type'=>'hidden','readonly' => false, 'value' => Yii::$app->request->get('id')])->label(false) ?>

         
    <?= $form->field($stock, 'STOC_CANTIDAD')->textInput(['type' => 'number', "required" => true]) ?>
    <div class="row" style="font-size: 18px" >
        <div class="col-md-2 col-xs-4">
            <p>
                 <span class="label label-danger full-block">MINIMO <span id="min-amount" ></span> </span>
                 <input type="hidden" name="stock-min" id="stock-min" />
            </p>
        </div>
        <div class="col-md-2 col-xs-4 pull-right">
            <p>
                 <span class="label label-warning full-block">MAXIMO <span id="max-amount" ></span></span>
                 <input type="hidden" name="stock-max" id="stock-max" />
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
            )->textInput([ "required" => false, "id" => "entry-expiration-date" ]);
        ?>   
    </section>

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

        function main()
        {

            // - - - Initialize Select2 Plugin - - -
            $('select').select2({placeholder: 'Seleccione un Item'});
            // - - - Initialize Datepicker Plugin
            $('input[name*=\"STVE_FECHAVENCIMIENTO\"]').datepicker({
                format: 'yyyy-mm-dd',
            });

            $('#stock-manual-period').click(function(e){
                let me = $('input[name=\'manual-period\']');
                
                me.val( me.val() === 'auto' ? 'manual' : 'auto');
                
                $('#collapse-period').toggle();
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
                var expirable = selected.data().expirable;

                expirable     = selected.data().expirable === 1 ? true : false;

                $('#flow-expirable').removeClass( expirable  ? 'hidden' : '' )
                                    .addClass   ( !expirable ? 'hidden' : '' )
                $('#entry-expiration-date').attr('required', expirable ? true : false );
                // - - - Set the expirable input for server procesing - - -
                $('#is-expirable').val(expirable)

                // - - - save current expirable
                lS.set('currentExpirable', expirable);

                setMinAndMax(selected);
            }

            function getSelectedData()
            {
                var me = $('[name=\'Stock[ITEM_ID]\']').find(':selected')
                return me;
            }

            function setMinAndMax(selected)
            {
                let myData      = selected.data();
                let amountField = $('[name*=\'CANTIDAD\']');

                if(myData.expirable == 1)
                {
                    // - - - Min and Max values
                    $('#min-amount').text( myData.subclass.ITCO_MIN );
                    $('#stock-min').val( myData.subclass.ITCO_MIN );
                    // - - - - - - - - - - - - - - - - - - - - - - - -
                    $('#max-amount').text( myData.subclass.ITCO_MAX );
                    $('#stock-max').val( myData.subclass.ITCO_MAX );

                    amountField.attr( 'min', myData.subclass.ITCO_MIN )
                    amountField.attr( 'max', myData.subclass.ITCO_MAX );
                }
            }

            showExpirationDateAndMinMax();

        }
    ");
?>
