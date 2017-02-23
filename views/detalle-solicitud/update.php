<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleSolicitud */

$this->title = 'Update Detalle Solicitud: ' . $model->DESO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Detalle Solicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DESO_ID, 'url' => ['view', 'id' => $model->DESO_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detalle-solicitud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
