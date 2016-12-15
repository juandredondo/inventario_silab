<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoMovimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Movimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-movimiento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipo Movimiento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TIMO_ID',
            'TIMO_NOMBRE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
