<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Factura */

$this->title = 'Update Factura: ' . $model->FACT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Facturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->FACT_ID, 'url' => ['view', 'id' => $model->FACT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="factura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
