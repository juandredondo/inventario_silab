<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FuncionarioLaboratorioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Funcionario Laboratorios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcionario-laboratorio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Funcionario Laboratorio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'FULA_ID',
            'FUNC_ID',
            'LABO_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
