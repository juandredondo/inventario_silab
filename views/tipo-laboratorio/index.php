<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoLaboratorioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Laboratorios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-laboratorio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipo Laboratorio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TILA_ID',
            'TILA_NOMBRE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
