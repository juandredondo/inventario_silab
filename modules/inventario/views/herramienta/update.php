<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Herramienta */

$this->title = 'Update Herramienta: ' . $model->HERR_ID;
$this->params['breadcrumbs'][] = ['label' => 'Herramientas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->HERR_ID, 'url' => ['view', 'id' => $model->HERR_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="herramienta-update content card">

    <?= $this->render('_form', [
        'model'     => $model,
        'itemId'    => $itemId,
    ]) ?>

</div>
