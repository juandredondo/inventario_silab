<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoLaboratorio */

$this->title = 'Create Tipo Laboratorio';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Laboratorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-laboratorio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
