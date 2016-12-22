<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemConsumibleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Consumibles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-consumible-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Consumible', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ITCO_ID',
            'ITEM_ID',
            'estadoConsumible_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
