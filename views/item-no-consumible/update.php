<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemNoConsumible */

$this->title = 'Update Item No Consumible: ' . $model->ITNC_ID;
$this->params['breadcrumbs'][] = ['label' => 'Item No Consumibles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ITNC_ID, 'url' => ['view', 'id' => $model->ITNC_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-no-consumible-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
