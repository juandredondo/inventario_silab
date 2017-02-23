<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\DetalleSolicitudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detalle Solicituds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalle-solicitud-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Detalle Solicitud', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'DESO_ID',
            'DESO_CANTIDAD',
            'SOLI_ID',
            'STOC_ID',
            'DESO_VALIDO:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
