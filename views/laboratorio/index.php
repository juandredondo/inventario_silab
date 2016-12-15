<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LaboratorioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laboratorios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratorio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Laboratorio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'LABO_ID',
            'LABO_NOMBRE',
            'LABO_NIVEL',
            'EDIF_ID',
            'COOR_ID',
            // 'TILA_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
