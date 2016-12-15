<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemConsumible */

$this->title = 'Create Item Consumible';
$this->params['breadcrumbs'][] = ['label' => 'Item Consumibles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-consumible-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
