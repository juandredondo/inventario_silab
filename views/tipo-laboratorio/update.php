<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoLaboratorio */

$this->title = 'Update Tipo Laboratorio: ' . $model->TILA_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Laboratorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TILA_ID, 'url' => ['view', 'id' => $model->TILA_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-laboratorio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
