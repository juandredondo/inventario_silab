<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccesoriosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accesorios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accesorios-index content card">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Accesorios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ACCE_ID',
            'itemNoConsumible.item.ITEM_NOMBRE',
            'itemNoConsumible.item.marca.MARC_NOMBRE',
            'itemNoConsumible.estadoNoConsumible.ESNC_NOMBRE',
            'ACCE_SERIAL',
            'ACCE_MODELO',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
