<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Provedor */

$this->title = $model->PROV_ID;
$this->params['breadcrumbs'][] = ['label' => 'Provedors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provedor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PROV_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PROV_ID], [
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
            'PROV_ID',
            'PROV_NOMBRE',
            'PROV_NIT',
        ],
    ]) ?>

</div>
