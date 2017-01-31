<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LaboratorioConfig */

$this->title = $model->LACO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Laboratorio Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratorio-config-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->LACO_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->LACO_ID], [
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
            'LACO_ID',
            'PERI_ID',
            'LACO_STOCKMIN',
            'LACO_STOCKMAX',
            'LABO_ID',
            'TIIT_ID',
            'LACO_MAXINVENTARIOS',
            'LACO_EXTRADATA',
        ],
    ]) ?>

</div>
