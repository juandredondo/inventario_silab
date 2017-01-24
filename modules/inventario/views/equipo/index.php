<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-index  content card">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Equipo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'EQUI_ID',
            'itemNoConsumible.item.ITEM_NOMBRE',
            'itemNoConsumible.item.marca.MARC_NOMBRE',
            'itemNoConsumible.estadoNoConsumible.ESNC_NOMBRE',
            'EQUI_SERIAL',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
