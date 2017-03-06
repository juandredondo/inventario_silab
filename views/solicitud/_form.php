<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
use yii\web\View;
use wbraganca\dynamicform\DynamicFormWidget;

use app\components\widgets\DropDownWidget;

use app\modules\inventario\models   as InventoryModels;
use app\models                      as Models;
/* @var $this yii\web\View */
/* @var $model app\models\Solicitud */
/* @var $form yii\widgets\ActiveForm */

$stockModel = new InventoryModels\Stock();
$options    = generateOptions($items);

function generateItemsList($model, $options, $params = [])
{
    $select     = "<select {attributes}>{options}</select>";

    $attributes = [ 
            "name"      => Html::getInputName( $model, isset($params["name"]) ? $params[ "name" ] : "STOC_ID" ), 
            "class"     => [ "form-control", "select"  ],
            "required"  => true
    ];

    $select = str_replace( "{attributes}", Html::renderTagAttributes($attributes), $select );
    $select = str_replace( "{options}", implode ( "" , $options ), $select );

    echo $select;
}

function generateOptions($stocks)
{
    $options    = ["<option></option>"];
    foreach($stocks as $stock)
    {
        $item = $stock->item;
        $info = $item->traverseInfo();
        $optionsAttr = [
            "value" => $stock->id,
            "data" => [
                "expirable"     => $item->isExpirable ? "true" : "false",
                "consumible"    => $stock->isConsumible ? "true" : "false", 
                "min"           => $stock->STOC_MIN,
                "amount"        => $stock->STOC_CANTIDAD,
                "max"           => $stock->STOC_MAX
            ]
        ];
        
        if($info instanceof ExpirableInterface)
            $optionsAttr[ "data" ][ "expiration" ] = $info->expirationDate;

        $option = "<option {options}>{text}</option>";
        $option = str_replace("{options}", Html::renderTagAttributes( $optionsAttr ), $option );
        $option = str_replace("{text}", $item->ITEM_NOMBRE, $option );

        array_push($options, $option);
    }

    return $options;
}

$this->registerJs("
    var all_stocks = ". Json::encode($items) . "
", View::POS_HEAD);

?>


 <div class="accordion" data-order-forms>
     <button type="button" class="btn btn-info" data-toggle="collapse" data-next='[data-item]' data-target="[data-order]" data-parent="[data-order-forms]">Buscar Item 1?</button> 
    <div class="row">
        <div data-item class="col-md-12 collapse">
            <?php 
               echo $this->render('@inventarioViews/stock/index', [  
                    'searchModel'  => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            ?>
        </div>
        <div data-order class="col-md-12 collapse in">
            
        </div>
    </div>
</div>
<div class="solicitud-form">
    <?php $form = ActiveForm::begin([ 'id' => 'order-form' ]); ?>

    <?= $form->field($model, 'SOLI_CODIGO')->textInput(['maxlength' => true]) ?>

    <? 
        echo DropDownWidget::widget([
            "form"      => $form,
            "model"     => [
                "main" => $model,
                "ref"  => Models\TipoSolicitud::classname()
            ],
            "columns"   => [
                "id" => "TISO_ID", "text" => "TISO_NOMBRE"
            ]
        ]); 
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="content panel">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton'  => '.remove-item', // css class
                    'model'         => $detailItems[ 0 ],
                    'formId'        => 'order-form',
                    'formFields' => [
                        'STOC_ID',
                        'DESO_CANTIDAD',
                        'DESO_VALIDO'
                    ],
                ]); ?>
                
                <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($detailItems as $i => $detail): ?>
                    <div class="item well" data-item-detail="<?= "{$i}" ?>">
                        <?php
                                // necessary for update action.
                                if (! $detail->isNewRecord) {
                                    echo Html::activeHiddenInput($detail, "[{$i}]id");
                                }

                                $min = isset($detail->stock->STOC_MIN) ? $detail->stock->STOC_MIN : 1;
                                $max = isset($detail->stock->STOC_MAX) ? $detail->stock->STOC_MAX : 1;
                            ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?
                                        echo DropDownWidget::widget([
                                            "form" => $form,
                                            "refData" => $items,
                                            "model" => [
                                                "main" => $detail
                                            ],
                                            "columns" => [
                                                "attribute" => "[{$i}]STOC_ID", "id" => "STOC_ID", "text" => "ITEM_NOMBRE"
                                            ],
                                            "label" => false,
                                            "options" => [
                                                // Options for <option>
                                                "options" => [
                                                    "dataManager" => function($stock) {
                                                        $item = $stock->item;
                                                        return [
                                                            "data-expirable"     => $item->isExpirable ? "true" : "false",
                                                            "data-consumible"    => $stock->isConsumible ? "true" : "false", 
                                                            "data-min"           => $stock->STOC_MIN,
                                                            "data-amount"        => $stock->STOC_CANTIDAD,
                                                            "data-max"           => $stock->STOC_MAX
                                                        ];
                                                    }
                                                ]
                                            ]
                                        ]); 
                                    ?>
                                </div>
                                <div data-amount-group class="col-sm-4">
                                    <?= $form->field($detail, "[{$i}]DESO_CANTIDAD")
                                             ->textInput([ "type" => "number", "min" => $min, "max" => $max, "data" => [ "amount" => null ] ])
                                             ->label(false) ?>
                                    <div class="row" style="font-size: 18px" >
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <p>
                                                <span class="label label-danger full-block">MIN<span class="hidden-xs hidden-sm">IMO</span> <span data-min-amount ><?=$min?></span> </span>
                                                <input type="hidden" name="<?= Html::getInputName( $stockModel, "[{$i}]STOC_MIN" ) ?>" data-stock-min />
                                            </p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 pull-right">
                                            <p>
                                                <span class="label label-warning full-block">MAX<span class="hidden-xs hidden-sm">IMO</span> <span data-max-amount ><?=$max?></span></span>
                                                <input type="hidden" name="<?= Html::getInputName( $stockModel, "[{$i}]STOC_MAX" ) ?>" data-stock-max />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <input type="checkbox" name=<?= $detail->formName() . "[{$i}][DESO_VALIDO]" ?> value="<?= 1 ?>" />
                                    <div class="btn-group">
                                        <button type="button" class="add-item btn btn-success btn-sm btn-flat" ><i class="glyphicon glyphicon-plus"></i></button>
                                        <button type="button" class="remove-item btn btn-danger btn-sm btn-flat"><i class="glyphicon glyphicon-minus"></i></button>
                                    </div>
                                </div>
                            </div><!-- .row -->
                    </div>
                <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?></div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


<?php 
    $this->registerJs("
        $('body').on('change', '[name*=\'STOC_ID\']', selectStock);

        function selectStock(e) 
        {
            let me           = $(this);
            let selectData   = me.children(':selected').data();


            let parent       = me.closest('[data-item-detail]');
            let amountGroup  = parent.find('[data-amount-group]');

            amountGroup      = {
                field: amountGroup.find('[data-amount]'),
                min: {
                    field:  amountGroup.find('[data-stock-min]'),
                    spot:  amountGroup.find('[data-min-amount]'),
                },
                max: {
                    field:  amountGroup.find('[data-stock-min]'),
                    spot:  amountGroup.find('[data-max-amount]'),
                }
            };

            amountGroup.field.attr('min', selectData.min );
            amountGroup.min.field.val('min', selectData.min );
            amountGroup.min.spot.text( selectData.min );

            amountGroup.field.attr('max', selectData.max );
            amountGroup.max.field.val('max', selectData.max );
            amountGroup.max.spot.text( selectData.max );

        }

        $('.dynamicform_wrapper').on('afterInsert', function(e, item) {
            let me      = $(item);
            let count   = $('.dynamicform_wrapper .item').length;
            let select  = me.find('select')

            me.attr( 'data-item-detail', count - 1 );

            select.val('');
            select.select2({placeholder: 'Seleccione una opcion'});
        });

        $('.dynamicform_wrapper').on('afterDelete', function(e, item) {
            let items = $('.dynamicform_wrapper .item');
            let i     = 0;

            items.each(function(){
                let me = $(this);
                me.attr( 'data-item-detail', i++ );
            })
        });

    ");
?>
