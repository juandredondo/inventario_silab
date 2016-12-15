<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SimboloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Simbolos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simbolo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Simbolo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SIMB_ID',
            'SIMB_NOMBRE',
            'SIMB_CODIGO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
