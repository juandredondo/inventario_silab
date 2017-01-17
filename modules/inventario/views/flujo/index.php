<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FlujoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="flujo-index box box-default">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'FLUJ_CANTIDAD',
            [
                'attribute' => 'MOVI_ID',
                'format'    => "html",
                'value'     => function($model, $widget)
                {
                    return $model->MOVI_ID === null ? 
                        "<span class='label label-primary'>INGRESO MANUAL</span>" : 
                        "<span class='label label-success'>INGRESO POR PEDIDO</span>";
                }
            ],
            [
                'attribute' => 'TIFU_ID',
                'format'    => 'html',
                'value'     => function($model)
                {
                    return $model->tipoFlujo->TIFL_NOMBRE === "ENTRADA" ? 
                        "<strong><i class='text-green icon-bottom material-icons md-24'>keyboard_arrow_up</i></strong>" :
                        "<strong><i class='text-red icon-bottom material-icons md-24'>keyboard_arrow_down</i></strong>" ;
                }
            ],
            'FLUJ_FECHA'
        ],
    ]); ?>
</div>
