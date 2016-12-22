<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Edificio;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LaboratorioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'LABORATORIOS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratorio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Laboratorio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'LABO_ID',
            'LABO_NOMBRE',
            'LABO_NIVEL',
            [
                'attribute' => 'Edificio',
                'value'     => '$data->edificio->EDIF_NOMBRE',
            ],
            [
                'attribute' => 'Coordinador',
                'value'     => '$data->coordinador->persona->PERS_NOMBRE',
            ],
            [
                'attribute' => 'Tipo',
                'value'     => '$data->tipolaboratorio->TILA_NOMBRE',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
