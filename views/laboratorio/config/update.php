<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LaboratorioConfig */

$this->title = 'Update Laboratorio Config: ' . $model->LACO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Laboratorio Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->LACO_ID, 'url' => ['view', 'id' => $model->LACO_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="laboratorio-config-update content card">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
