<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipoidentificacion */

$this->title = 'Update Tipoidentificacion: ' . $model->TIID_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tipoidentificacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TIID_ID, 'url' => ['view', 'id' => $model->TIID_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipoidentificacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
