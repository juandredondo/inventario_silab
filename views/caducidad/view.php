<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Caducidad */

$this->title = $model->CADU_ID;
$this->params['breadcrumbs'][] = ['label' => 'Caducidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caducidad-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CADU_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CADU_ID], [
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
            'CADU_ID',
            'CADU_NOMBRE',
            'CADU_MIN',
            'CADU_MAX',
        ],
    ]) ?>

</div>
