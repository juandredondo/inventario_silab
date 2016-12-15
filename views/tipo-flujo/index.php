<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoFlujoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Flujos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-flujo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipo Flujo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TIFL_ID',
            'TIFL_NOMBRE',
            'TIFL_CONSTANTE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
