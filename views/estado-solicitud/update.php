<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoSolicitud */

$this->title = 'Update Estado Solicitud: ' . $model->ESSO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Estado Solicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ESSO_ID, 'url' => ['view', 'id' => $model->ESSO_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estado-solicitud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
