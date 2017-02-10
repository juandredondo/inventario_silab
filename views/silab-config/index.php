<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Silab Configs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="silab-config-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Silab Config', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SILAB_ID',
            'SILAB_VERSION',
            'SILAB_PATH',
            'SILAB_NAME',
            'SILAB_STOCK_MIN',
            // 'SILAB_STOCK_MAX',
            // 'SILAB_MAX_INVENTARIOS',
            // 'createdAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
