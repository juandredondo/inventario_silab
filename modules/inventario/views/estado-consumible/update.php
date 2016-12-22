<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoConsumible */

$this->title = 'Update Estado Consumible: ' . $model->ESCO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Estado Consumibles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ESCO_ID, 'url' => ['view', 'id' => $model->ESCO_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estado-consumible-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
