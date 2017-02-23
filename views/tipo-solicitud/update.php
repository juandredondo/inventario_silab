<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoSolicitud */

$this->title = 'Update Tipo Solicitud: ' . $model->TISO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Solicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TISO_ID, 'url' => ['view', 'id' => $model->TISO_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-solicitud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
