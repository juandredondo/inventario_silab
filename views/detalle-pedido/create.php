<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetallePedido */

$this->title = 'Create Detalle Pedido';
$this->params['breadcrumbs'][] = ['label' => 'Detalle Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalle-pedido-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
