<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Laboratorio */

$this->title = $model->LABO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Laboratorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratorio-view col-md-6">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        
            'LABO_ID',
            'LABO_NOMBRE',
            'LABO_NIVEL',
            'edificio.EDIF_NOMBRE',
            'coordinador.persona.PERS_NOMBRE',
            'tipolaboratorio.TILA_NOMBRE',

        ],
    ]) ?>
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->LABO_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Agregar Funcionarios', ['funcionario-laboratorio/create', 'idLaboratorio' => $model->LABO_ID], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a('Eliminar', ['delete', 'id' => $model->LABO_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>

<div class="col-md-6">
    <h1><?= Html::encode("Funcionarios ") ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'FULA_ID',
            'funcionario.persona.PERS_NOMBRE',
            // 'laboratorio.LABO_NOMBRE',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons'  =>
                 [
                    'view'=>function($model, $key,$url){
                           

                            },
                    'update'=>function($model, $key,$url){
                                $url=Yii::$app->urlManager->createUrl(['funcionario/update', 'id' => $key->FUNC_ID]);
                          

                            },
                    'delete'=>function($model, $key,$url){
                                $url=Yii::$app->urlManager->createUrl(['funcionario-laboratorio/delete', 'id' => $key->FULA_ID]);
                            return Html::a('<span class=" glyphicon glyphicon-trash"> </span>', $url ,
                                [
                                    'title' => \Yii::t('yii', 'Eliminar'),
                                ]);    

                            },
                   
                ],





            ],




        ],
    ]); ?>
</div>


