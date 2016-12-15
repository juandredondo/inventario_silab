<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetallePedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detalle Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalle-pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Detalle Pedido', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'DEPE_ID',
            'DEPE_CANTIDAD',
            'PEDI_ID',
            'ITEM_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
