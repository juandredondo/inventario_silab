<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\config\SilabConfig */

$this->title = $model->SILAB_ID;
$this->params['breadcrumbs'][] = ['label' => 'Silab Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="silab-config-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->SILAB_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->SILAB_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'SILAB_ID',
            'SILAB_VERSION',
            'SILAB_PATH',
            'SILAB_NAME',
            'SILAB_STOCK_MIN',
            'SILAB_STOCK_MAX',
            'SILAB_MAX_INVENTARIOS',
            'createdAt',
        ],
    ]) ?>

</div>
