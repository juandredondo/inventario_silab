<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Laboratorio */

$this->title = 'Update Laboratorio: ' . $model->LABO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Laboratorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->LABO_ID, 'url' => ['view', 'id' => $model->LABO_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="laboratorio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
	
</div>
