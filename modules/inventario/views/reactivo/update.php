<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reactivo */

$this->title = 'Actualizar Reactivo: ' . $model->item->ITEM_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Reactivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item->ITEM_NOMBRE, 'url' => ['view', 'id' => $model->REAC_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reactivo-update content card">

    <?= $this->render('_form', [
        'model'     => $model,
        'itemId'    => $itemId,
    ]) ?>

</div>
