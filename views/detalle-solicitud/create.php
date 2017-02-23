<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetalleSolicitud */

$this->title = 'Create Detalle Solicitud';
$this->params['breadcrumbs'][] = ['label' => 'Detalle Solicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalle-solicitud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
