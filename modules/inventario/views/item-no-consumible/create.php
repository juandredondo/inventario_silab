<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemNoConsumible */

$this->title = 'Create Item No Consumible';
$this->params['breadcrumbs'][] = ['label' => 'Item No Consumibles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-no-consumible-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
