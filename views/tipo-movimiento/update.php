<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoMovimiento */

$this->title = 'Update Tipo Movimiento: ' . $model->TIMO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Movimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TIMO_ID, 'url' => ['view', 'id' => $model->TIMO_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-movimiento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
