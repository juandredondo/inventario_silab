<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Movimiento */

$this->title = 'Update Movimiento: ' . $model->MOVI_ID;
$this->params['breadcrumbs'][] = ['label' => 'Movimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MOVI_ID, 'url' => ['view', 'id' => $model->MOVI_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="movimiento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
