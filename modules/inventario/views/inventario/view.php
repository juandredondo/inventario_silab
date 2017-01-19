<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;

use app\modules\inventario\models\Stock;
/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = $model->INVE_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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
                    'descripcion',
                    [
                        'attribute' => "Periodo Vigente",
                        'format'    => "html",
                        'value'     => checkPeriodo($model)
                    ],
                ],
            ]) ?>
        </div>

        <div class="col-md-12">
            <h3>Items del inventario</h3>
            <div class="box">
                <?php   
                
                $dataProvider = new ActiveDataProvider([
                        'query' => Stock::find()->where(['INVE_ID' => $model->INVE_ID]),
                        'pagination' => [
                            'pageSize' => 4,
                        ],
                    ]);
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                                'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'item.ITEM_NOMBRE',
                            'item.marca.MARC_NOMBRE',
                            [
                                'attribute' => 'STOC_CANTIDAD',
                                'value'     => function($model)
                                {
                                    return $model->calculateAmount();
                                }
                            ],
                            'periodo.PERI_FECHA',
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
                            ['class' => 'yii\grid\ActionColumn'],
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
