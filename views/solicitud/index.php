<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicituds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Solicitud', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SOLI_ID',
            'SOLI_FECHA',
            'SOLI_CODIGO',
            'TISO_ID',
            'ESSO_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
