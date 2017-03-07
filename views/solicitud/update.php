<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitud */

$this->title = 'Update Solicitud: ' . $model->SOLI_ID;
$this->params['breadcrumbs'][] = ['label' => 'Solicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SOLI_ID, 'url' => ['view', 'id' => $model->SOLI_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="solicitud-update content card">
    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
        'detailItems' => $detailItems,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
