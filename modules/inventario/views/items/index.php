<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index content card">
    
    <p>
        <?= Html::a('Create Items', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="icon-bottom material-icons md-18">filter_list</i> Filtrar', ['#'], [
                'class'         => 'btn btn-default',
                "data-toggle"   => "modal", 
                "data-target"   => "#filter-modal" 
            ]) 
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ITEM_ID',
            'ITEM_NOMBRE',
            'ITEM_OBSERVACION:ntext',
            'MARC_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php Modal::begin([
    "id"    =>  "filter-modal",
    "header" => "Filtrar inventarios!",
    "footer"=>  "",// always need it for jquery plugin
])?>
    <?php  echo $this->render('_search', ['item' => $searchModel]); ?>
<?php Modal::end(); ?>