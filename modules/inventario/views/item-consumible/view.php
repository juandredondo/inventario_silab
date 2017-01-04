<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ItemConsumible */

$this->title = $model->ITCO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Item Consumibles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attributes = require (Yii::getAlias('@inventarioViews').'/item-consumible/_attributes.php');

?>
<div class="item-consumible-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ITCO_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ITCO_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => 
    ]) ?>

</div>
