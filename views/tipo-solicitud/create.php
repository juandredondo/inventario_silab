<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoSolicitud */

$this->title = 'Create Tipo Solicitud';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Solicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-solicitud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
