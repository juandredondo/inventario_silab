<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$title = "Configuraciones"
?>
<div class="laboratorio-config-index content card">

    <h1><?= Html::encode($title) ?></h1>

    <p>
        <?= Html::a('Create Laboratorio Config', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'LACO_ID',
            'LACO_STOCKMIN',
            'LACO_STOCKMAX',
            // 'TIIT_ID',
            // 'LACO_MAXINVENTARIOS',
            // 'LACO_EXTRADATA',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
