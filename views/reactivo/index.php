<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReactivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reactivos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reactivo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reactivo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'REAC_ID',
            'REAC_CODIGO',
            'REAC_UNIDAD',
            'REAC_FECHA_VENCIMIENTO',
            'ITCO_ID',
            // 'UBIC_ID',
            // 'CADU_ID',
            // 'SIMB_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
