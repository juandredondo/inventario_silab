<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <p>
        <?= Html::a('Create Stock', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="icon-bottom material-icons md-18">filter_list</i> Filtrar', ['#'], [
                'class'         => 'btn btn-default',
                "data-toggle"   => "modal", 
                "data-target"   => "#stock-filter-modal" 
            ]) 
        ?>
    </p>
    <?php Pjax::begin(["id" => "pjax-stock", 'timeout' => 100000]); ?>
        <?= GridView::widget([
            "id"            => "stock-items-grid",
            'dataProvider'  => $dataProvider,
            'filterModel'   => $searchModel,
            "filterUrl"     => ["/inventario/stock/index"],
            "rowOptions"    => function($model, $key, $index, $grid) {
                
                $options = [
                    "data" => [
                        "key" => $model->STOC_ID,      
                    ]
                ];

                $options[ "data" ][ "item" ] = [
                    "min"       => $model->STOC_MIN,
                    "max"       => $model->STOC_MIN,
                    "amount"    => $model->STOC_CANTIDAD
                ];

                return $options;
            },
            'columns' => [
                [
                    'class' => 'yii\grid\CheckBoxColumn',
                    'name'  => 'select-stocks'
                ],
                'ITEM_NOMBRE',
                'TIIT_NOMBRE',
                'STOC_CANTIDAD',
                'STOC_MIN',
                'STOC_MAX',
                ['class' => 'yii\grid\ActionColumn'],
            ],
            
        ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php 
    Modal::begin([
        "footer" => "",
        "id" => "stock-filter-modal"
    ]);
?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
<?php 
    Modal::end();
?>

<?php 
    $this->registerjs("
        
        $(document).on('ready', function(){
            silab.helpers.grid.selectRows('#stock-items-grid');
        });

        $(document).on('pjax:send', function() {
            silab.overlay.toggle('process', 'Cargando');
            silab.helpers.grid.getSelectedRows('#stock-items-grid');
        })

        $(document).on('pjax:complete', function() {
            silab.overlay.toggle('process');
            silab.helpers.grid.selectRows('#stock-items-grid');
        })

    ");
?>
