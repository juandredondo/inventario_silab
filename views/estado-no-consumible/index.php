<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadoNoConsumibleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estado No Consumibles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-no-consumible-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Estado No Consumible', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ESNC_ID',
            'ESNC_NOMBRE',
            'ESNC_CODIGO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
