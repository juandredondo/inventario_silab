<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FuncionarioLaboratorio */

$this->title = 'Create Funcionario Laboratorio';
$this->params['breadcrumbs'][] = ['label' => 'Funcionario Laboratorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcionario-laboratorio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
