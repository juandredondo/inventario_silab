<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FuncionarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Funcionarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcionario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Funcionario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'FUNC_ID',
            'PERS_ID',
            'Nombre',
            'Identificacion',
            'persona.genero.GENE_NOMBRE',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{eliminar}',


                'buttons'=>[
                            'eliminar'=>function ($model, $key,$url) {


                        $url=Yii::$app->urlManager->createUrl(['funcionario/delete', 'id' => $key->PERS_ID ]);
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
