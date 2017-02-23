<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use app\components\widgets\AlertDimissible;
use kartik\grid\GridView;

use app\modules\inventario\models\Stock;
use app\modules\inventario\models\Flujo;
use app\modules\inventario\models\TipoFlujo;
use app\modules\inventario\models\TipoItem;
use app\modules\inventario\models\Unidad;

use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title                    = $model->INVE_NOMBRE;
$this->params['breadcrumbs'][]  = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][]  = $this->title;
$GLOBALS[ "laboratory-config" ] = $model->laboratorio->currentConfig;

function checkPeriodo($model)
{
    $periodo = $model->periodo;
    if($periodo !== null)
        return $periodo->esVigente() ? 
                "<span class='label label-success'><i class=''></i> VIGENTE (" . $model->periodo->alias . ")</span>": 
                "<span class='label label-warning'><i></i> CADUCADO (" . $model->periodo->alias . ")</span>";
    else
        return $periodo;
}

?>
<div class="inventario-view content card">
    <div class="row">
        <div id="item-alert-spot" class="col-md-12">
            <?php 
                echo AlertDimissible::widget();
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>
                <?= Html::a('<i class="icon-bottom material-icons md-18">mode_edit</i> <span class="hidden-xs">Editar</span>', ['update', 'id' => $model->INVE_ID], ['class' => 'btn btn-primary btn-flat']) ?>
                <?= Html::a('<i class="icon-bottom material-icons md-18">delete</i> <span class="hidden-xs">Borrar</span>', ['delete', 'id' => $model->INVE_ID], [
                    'class' => 'btn btn-danger btn-flat',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'INVE_ID',
                    'nombre',
                    'alias',
                    'descripcion'
                ],
            ]) ?>
        </div>

        <div class="col-md-12">
            <h3>Items del inventario</h3>
            <?= Html::a('<i class="icon-bottom material-icons md-18">add</i> <span class="hidden-xs"></span>', 
                    ['stock/add', 'id' => $model->INVE_ID], 
                    ['class' => 'btn btn-primary btn-flat']
                ) 
            ?>
            <div class="box">
                <?=  GridView::widget([
                        'dataProvider' => $dataProvider,
                                'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'ITEM_ID',
                            'ITEM_NOMBRE',
                            'item.marca.MARC_NOMBRE',
                            [
                                'attribute' => 'STOC_CANTIDAD',
                                'format'    => 'raw',
                                'value'     => function($model)
                                {
                                    $und   =  Unidad::getItemUnity( $model->item->ITEM_ID );
                                    $datas = [
                                        "expirable"     => $model->item->isExpirable ? "true" : "false",
                                        "stock"         => $model->STOC_ID,
                                        "amount"        => $model->calculateAmount(),
                                        "stock-min"     => $GLOBALS[ "laboratory-config" ]->LACO_STOCKMIN,
                                        "stock-max"     => $GLOBALS[ "laboratory-config" ]->LACO_STOCKMAX,
                                        "consumible"    => Json::encode( $model->item->traverseInfo()->parent )
                                        
                                    ];
                                    $html  = '<div ' . Html::renderTagAttributes( [ "data" => $datas ] ) . ' class="hoverable-tools"><div class="col-xs-7">
                                                    <span class="pull-left"><b>{cantidad}</b></span> <span class="pull-right">{unidad}</span>
                                                </div>
                                                <div class="col-xs-5">
                                                    <div class="tools btn-group-vertical" role="group">
                                                        <a href="#" data-flow="' . TipoFlujo::Entrada . '" data-toggle="modal" data-target="#flow-modal" class="text-green"><i class="icon-bottom material-icons md-24">add_circle</i></a>
                                                        <a href="#" data-flow="' . TipoFlujo::Salida . '" data-toggle="modal" data-target="#flow-modal" class="text-red"><i class="icon-bottom material-icons md-24">remove_circle</i></a>
                                                    </div>
                                                </div></div>';   

                                    return str_replace( 
                                                "{unidad}", $und,
                                                str_replace("{cantidad}", $datas[ "amount" ], $html )
                                           );
                                }
                            ],
                            'periodo.PERI_FECHA',
                            [
                                'attribute' => 'STOC_ESCONSUMIBLE',
                                'value'     => function($model)
                                {
                                    return $model->STOC_ESCONSUMIBLE ? "CONSUMIBLE" : "NO CONSUMIBLE";
                                }
                            ],
                            
                            [
                                'class'     => 'kartik\grid\ExpandRowColumn',
                                'value'     => function($model, $key, $index, $column){
                                    return GridView::ROW_COLLAPSED;
                                },
                                'detail'    => function($model, $key, $index)
                                {
                                    $return = Yii::$app->controller->renderPartial(
                                        '/flujo/index.php', [
                                            'dataProvider' => new \yii\data\ArrayDataProvider(
                                                [
                                                    'allModels' => $model->flujos
                                                ]
                                            )
                                        ]
                                    );
                                    
                                    return $return;
                                    
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'urlCreator' => function($action, $model, $key, $index) { 
                                        if($action == "delete")
                                            return Url::to(["/inventario/stock/delete", 'id'=> $model->STOC_ID, 'fromInventory' => true]);
                                        else 
                                        {
                                            $item = strtolower( $model->item->tipoItem->TIIT_NOMBRE );
                                            return Url::to(["/inventario/". $item ."/". $action,'id'=>$key]);                                            
                                        }
                                },
                            ],
                        ],
                    ]);?> 
            </div>
        </div>
    </div>
</div>

<?php Modal::begin([
        "id"=>"ajaxCrudModal",
        "footer"=>"",// always need it for jquery plugin
    ])?>
<?php Modal::end(); ?>

<?php Modal::begin([
    "id"    =>  "flow-modal",
    "footer"=>  "",// always need it for jquery plugin
])?>
    <?php  
        $flowForm = "flow-form";

        echo $this->render('@inventarioViews/flujo/_form_entry', [
                'model'     => new Flujo,
                'formName' => $flowForm
            ]
        ); 
    ?>
<?php Modal::end(); ?>


<?php 
    $this->registerJs("
        $(document).on('ready', inventory_view);

        function inventory_view()
        {   
            $('#flow-modal').on('show.bs.modal', function(e){                

                if (e.namespace === 'bs.modal') {
                    
                    let form                = $('#". $flowForm . "'); 
                    let trigger             = $(e.relatedTarget);
                    let flow                = trigger.data( 'flow' );
                    let parent              = trigger.parents('.hoverable-tools');
                    let stock               = parent.data('stock');
                    let isExpirable         = parent.data('expirable');
                    let action              = form.find('input[name*=\'action\']').val();

                    console.log([
                        flow, stock, action
                    ]);

                    form.attr('action', action + (flow == 1 ? '/add-entry' : '/add-out') );
                    $('#". $flowForm . "' + ' #button-text').text( (flow == 1 ? 'Agregar!' : 'Extraer!') )
                    
                    $('input[name*=\'STOC_ID\']').val( stock );
                    $('input[name*=\'TIFU_ID\']').val( flow );

                    if( flow == 1 )
                    {
                        $('#flow-expirable').removeClass( isExpirable  ? 'hidden' : '' )
                                            .addClass   ( !isExpirable ? 'hidden' : '' )
                        $('#entry-expiration-date').attr('required', isExpirable ? true : false );
                    }
                    else if ( flow == 2 ) 
                    {
                        isExpirable = false;
                        // - - - - - - - -- 
                        $('#entry-expiration-date').attr('required', isExpirable ? true : false );
                        $('#flow-expirable').removeClass( isExpirable  ? 'hidden' : '' )
                                            .addClass   ( !isExpirable ? 'hidden' : '' )
                    }


                }
                
                
            });
        }
    ");
?>