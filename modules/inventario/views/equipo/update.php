<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = 'Update Equipo: ' . $model->EQUI_ID;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->EQUI_ID, 'url' => ['view', 'id' => $model->EQUI_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="equipo-update  content card">

    <?= $this->render('_form', [
        'model'     => $model,
        'itemId'    => $itemId,
    ]) ?>

</div>
