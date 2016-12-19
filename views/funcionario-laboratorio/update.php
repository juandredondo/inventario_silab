<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FuncionarioLaboratorio */

$this->title = 'Update Funcionario Laboratorio: ' . $model->FULA_ID;
$this->params['breadcrumbs'][] = ['label' => 'Funcionario Laboratorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->FULA_ID, 'url' => ['view', 'id' => $model->FULA_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="funcionario-laboratorio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


</div>
