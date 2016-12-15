<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EdificioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Edificios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edificio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Edificio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'EDIF_ID',
            'EDIF_NOMBRE',
            'EDIF_CODIGO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
