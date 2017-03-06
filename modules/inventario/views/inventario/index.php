<?php

use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                    = 'Inventarios';
$this->params['breadcrumbs'][]  = $this->title;
?>
<div class="inventario-index content card">

    <p>
        <?= Html::a('<i class="icon-bottom material-icons md-18">add</i> Agregar', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="icon-bottom material-icons md-18">filter_list</i> Filtrar', ['#'], [
                'class'         => 'btn btn-default',
                "data-toggle"   => "modal", 
                "data-target"   => "#filter-modal" 
            ]) 
        ?>
    </p>

    <?php Pjax::begin(["id" => "pjax-inventory", 'timeout' => 100000]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nombre',
                'descripcion',            
                'alias',
                'laboratorio.LABO_NOMBRE',
                [
                    'attribute' => 'INVE_ESSINGLETON',
                    'format'    => 'html',
                    'value'     => function($model) {
                        $template = "<span class='" . ( ($model->INVE_ESSINGLETON) ? "text-green" : "text-default" ) . "'>
                                        <i class='material-icons m18'>" . ( ($model->INVE_ESSINGLETON) ? "check_box" : "indeterminate_check_box" ) . "</i></span>";

                        return $template;
                    }
                ],
                /*[
                    'attribute' => "Cantidad de items",
                    'format'    => 'html',
                    'value'     => function($model)
                    {
                        return "<b>" . count($model->stocks) . "</b>";
                    }
                    
                ],*/
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

        <?php Modal::begin([
            "id"    =>  "filter-modal",
            "header" => "Filtrar inventarios!",
            "footer"=>  "",// always need it for jquery plugin
        ])?>
            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
        <?php Modal::end(); ?>
    <?php Pjax::end(); ?>
</div>

