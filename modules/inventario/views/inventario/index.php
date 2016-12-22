<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Inventario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombre',
            'descripcion',            
            'alias',
            'laboratorio.LABO_NOMBRE',
            [
                'attribute' => "Cantidad de items",
                'value'     => 'INVE_CANTIDAD'
            ],
            [
                'attribute' => "Periodo Vigente",
                'format'    => "html",
                'value'     => function($model)
                {
                    $periodo = $model->periodo;
                    if($periodo !== null)
                        return $periodo->esVigente() ? 
                                "<span class='label label-success'>VIGENTE (" . $model->periodo->alias . ")</span>": 
                                "<span class='label label-warning'>CADUCADO (" . $model->periodo->alias . ")</span>";
                    else
                        return $periodo;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php 
        //foreach($)  
    ?>
</div>
