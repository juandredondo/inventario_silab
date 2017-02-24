<?php 
    // Campos comunes de items
use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\Marca;
use app\models\Laboratorio;
use app\modules\inventario\models\core\TipoItem;



?>

    <div class="row">
        <div id="item-alert-spot" class="col-md-12">
        </div>
    </div>

    <?php
        
        $tipoItemInput = "";
        
        if(isset($item->TIIT_ID)) 
        {
            $tipoItemInput = $form->field($item, 'TIIT_ID')->textInput(["type" => "hidden"])->label(false);
        }
        else {
            $tipoItemInput =    DropDownWidget::widget(
                                    [
                                        "form"  =>  $form,
                                        "model" =>  [
                                            "main"  => $item,
                                        ],
                                        "refData"   => TipoItem::find()->where(['not', ['TIIT_PADRE' => null]])->all(),
                                        "columns"   => [
                                            "id"    =>  "TIIT_ID",
                                            "text"  =>  "TIIT_NOMBRE"
                                        ],
                                        "options" => [ "disabled" => ($itemId !== null && $itemId !== "") ? true : false ]
                                    ]
                                ); 
        }

    ?>

    <?php 

        $fields = [
            "item-nombre"       => $form->field($item, 'ITEM_NOMBRE')->textInput(['maxlength' => true]),
            "item-observacion"  => $form->field($item, 'ITEM_OBSERVACION')->textarea(['rows' => 6]),
            "item-MARC_ID"      => DropDownWidget::widget(
                [
                    "form"  =>  $form,
                    "model" =>  [
                        "main"  => $item,
                        "ref"   => Marca::className()
                    ],
                    "columns"   => [
                        "id"    =>  "MARC_ID",
                        "text"  =>  "MARC_NOMBRE"
                    ]
                ]
            ),
            "item-TIIT_ID" => $tipoItemInput,
        ];

        if( $item->isNewRecord )
        // Añadido control para registrar en stock de laboratorio de inmediato
        $fields[ "item-LABO_ID" ] = $this->render( "@app/views/templates/_php/_collapsable-field.php", [
                                    "data" => [
                                        "id" => "labo-toggler",
                                        "target" => "labo-container",
                                        "field" => [
                                            "name" => "LABO_ID",
                                            "html" => DropDownWidget::widget(
                                                        [
                                                            "form"  =>  $form,
                                                            "refData"   => Laboratorio::find()->all(),
                                                            "model" =>  [
                                                                "main"  => new Laboratorio()
                                                            ],
                                                            "columns"   => [
                                                                "id"    =>  "LABO_ID",
                                                                "text"  =>  "LABO_NOMBRE"
                                                            ],
                                                            "label" => false,
                                                            "options" => [
                                                                // Options for <option>
                                                                "options" => [
                                                                    "dataManager" => function($laboratory) {
                                                                        $config = $laboratory->currentConfig;
                                                                        return [ 
                                                                            "data-min"           => $config->min,
                                                                            "data-max"           => $config->max
                                                                        ];
                                                                    }
                                                                ]
                                                            ]
                                                        ]
                                                    )
                                        ],
                                        "default" => [
                                            "name"  => "labo-default",
                                            "off"   => "manual",
                                            "value" => ""
                                        ],
                                        "label" => "AGREGAR A LABORATORIO"
                                    ]
                                ]);

    ?>
        
    
    <?php 
        $this->registerJs( "
            // - - - Initialize Select2 Plugin - - -
                $('form[id*=\'item\'] select').select2();

                silab.submitForm( $('form[id*=\'item\']') );

                $('[name*=\'LABO_ID\']').change(function(e){
                    let me      = $(this).find(':selected');
                    let myData  = me.data();

                    var minMax = {
                        min: {
                           text: $('#item-stock-min, #min-amount'),
                           input: $('[name*=\'ITCO_MIN\']')
                        },
                        max: {
                           text: $('#item-stock-max, #max-amount'),
                           input: $('[name*=\'ITCO_MAX\']')
                        },
                    }

                    minMax.min.text.val( myData.min ).text( myData.min );
                    minMax.max.text.val( myData.max ).text( myData.max );

                    minMax.min.input.attr('min', myData.min).attr( 'max', myData.max );
                    minMax.max.input.attr('min', myData.min).attr( 'max', myData.max );

                });

                $('#labo-toggler').change(function(e){
                    
                    let me          = $(this);
                    let minData     = $('#item-stock-min').data().default;
                    let maxData     = $('#item-stock-max').data().default; 
                    let selected    = $('[name*=\'LABO_ID\']').find(':selected');

                    if( me.prop('checked') === true && selected.val() !== '' ) {
                        minData = selected.data().min;
                        maxData = selected.data().max;
                    }
                    
                    var minMax = {
                        min: {
                            text: $('#item-stock-min, #min-amount'),
                            input: $('[name*=\'ITCO_MIN\']')
                        },
                        max: {
                            text: $('#item-stock-max, #max-amount'),
                            input: $('[name*=\'ITCO_MAX\']')
                        },
                    }

                    minMax.min.text.val( minData ).text( minData );
                    minMax.max.text.val( maxData ).text( maxData );

                    minMax.min.input.attr( 'min', minData ).attr( 'max', maxData );
                    minMax.max.input.attr( 'min', minData ).attr( 'max', maxData );
                });

                

                /*
                $('form[id*=\'item\']').on('beforeSubmit', function(e){
                // - - - - Stop propagation
                    e.preventDefault();
                    e.stopPropagation();
                // - - - - It's Maui Time!
                let form = $(this);
                
                $.post(form.attr('action'), form.serialize(), success);

                function success(data)
                {
                    var insideModal = $('form[id*=\'item\']').animate({ scrollTop: 0 }, 'slow'); 
                    
                    displayAlert(data);
                }

                function displayAlert(data)
                {
                    let parent      = $('form[id*=\'item\']').closest('.modal');
                        parent      = parent.length ? parent : $('html, body');

                    data.message    = _.template( data.message )( { } );

                    parent.animate({ scrollTop: 0 }, 'slow');
                    
                    silab.helpers.addAlert('#item-alert-spot', data, true);
                     
                    if( typeof window.itemFormCallback !== 'undefined' )
                    {
                        window.itemFormCallback( data );
                    }
                                            
                }

                return false;
            });
            */

            //# sourceURL=item-form-handler.js
        " )
    ?>