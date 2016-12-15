<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoFlujo */

$this->title = 'Update Tipo Flujo: ' . $model->TIFL_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Flujos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TIFL_ID, 'url' => ['view', 'id' => $model->TIFL_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-flujo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
