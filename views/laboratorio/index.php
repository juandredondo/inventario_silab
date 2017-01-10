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
                'value'     => function($model, $widget)
                {
                    return $model->edificio->EDIF_NOMBRE;
                },
            ],
            [
                'attribute' => 'Coordinador',
                'value'     => function($model, $widget)
                {
                    return $model->coordinador->persona->PERS_NOMBRE;
                },
            ],
            [
                'attribute' => 'Tipo',
                'value'     => function($model, $widget)
                {
                    return $model->tipolaboratorio->TILA_NOMBRE;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
