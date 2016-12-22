<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoNoConsumible */

$this->title = 'Update Estado No Consumible: ' . $model->ESNC_ID;
$this->params['breadcrumbs'][] = ['label' => 'Estado No Consumibles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ESNC_ID, 'url' => ['view', 'id' => $model->ESNC_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estado-no-consumible-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
