<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReactivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reactivos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reactivo-index content card">

    <p>
        <?= Html::a('Create Reactivo', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="icon-bottom material-icons md-18">filter_list</i> Filtrar', ['#'], [
                'class'         => 'btn btn-default',
                "data-toggle"   => "modal", 
                "data-target"   => "#filter-modal" 
            ]) 
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'REAC_ID',
            'REAC_CODIGO',
            'unidad.UNID_NOMBRE',
            'REAC_FECHA_VENCIMIENTO',
            'ITCO_ID',
            // 'UBIC_ID',
            // 'CADU_ID',
            // 'SIMB_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php Modal::begin([
    "id"    =>  "filter-modal",
    "header" => "Filtrar Reactivos!",
    "footer"=>  "",// always need it for jquery plugin
])?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Modal::end(); ?>

