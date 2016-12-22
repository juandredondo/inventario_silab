<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadoConsumibleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estado Consumibles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-consumible-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Estado Consumible', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ESCO_ID',
            'ESCO_NOMBRE',
            'ESCO_MIN',
            'ESCO_MAX',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
