<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuditLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Audit Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audit-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Audit Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AULOG_ID',
            'AULOG_TABLENAME',
            'AULOG_FECHA',
            'USUA_ID',
            'LOTI_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
