<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Flujo */

$this->title = $model->FLUJ_ID;
$this->params['breadcrumbs'][] = ['label' => 'Flujos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flujo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->FLUJ_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->FLUJ_ID], [
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
            'FLUJ_ID',
            'FLUJ_CANTIDAD',
            'MOVI_ID',
            'STOC_ID',
            'TIFU_ID',
        ],
    ]) ?>

</div>
