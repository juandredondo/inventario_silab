<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemConsumible */

$this->title = 'Update Item Consumible: ' . $model->ITCO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Item Consumibles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ITCO_ID, 'url' => ['view', 'id' => $model->ITCO_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-consumible-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
