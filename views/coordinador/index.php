<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CoordinadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Coordinadors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coordinador-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Coordinador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([ 
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'COOR_ID',
            'PERS_ID',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{eliminar}',


                'buttons'=>[
                            'eliminar'=>function ($model, $key,$url) {


                        $url=Yii::$app->urlManager->createUrl(['coordinador/delete', 'id' => $key->PERS_ID ]);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url ,[
                                    'title' => \Yii::t('yii', 'Eliminar'),
                                    'data-confirm' => \Yii::t('yii', 'Desea usted eliminar a: '.$key->persona->PERS_NOMBRE."?"),
                                    'data-method' => 'post',
                                    'data-pjax' => '0', ]);     
                            },

                ],


            ],
        ],
    ]); ?>
</div>
