<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = 'Editar Inventario: ' . $model->INVE_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->INVE_NOMBRE, 'url' => ['view', 'id' => $model->INVE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inventario-update content card">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
