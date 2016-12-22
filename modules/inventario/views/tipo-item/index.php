<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tipo Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TIIT_ID',
            'TIIT_NOMBRE',
            'TIIT_PADRE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
