<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HerramientaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Herramientas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="herramienta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Herramienta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'HERR_ID',
            'HERR_CANTIDAD',
            'ITNC_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
