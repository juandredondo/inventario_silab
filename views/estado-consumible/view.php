<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoConsumible */

$this->title = $model->ESCO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Estado Consumibles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-consumible-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ESCO_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ESCO_ID], [
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
            'ESCO_ID',
            'ESCO_NOMBRE',
            'ESCO_MIN',
            'ESCO_MAX',
        ],
    ]) ?>

</div>
