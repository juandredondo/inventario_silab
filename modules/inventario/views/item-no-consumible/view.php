<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ItemNoConsumible */

$this->title = $model->ITNC_ID;
$this->params['breadcrumbs'][] = ['label' => 'Item No Consumibles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attributes = require (Yii::getAlias('@inventarioViews').'/item-no-consumible/_attributes.php');

?>
<div class="item-no-consumible-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ITNC_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ITNC_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $attributes
    ]) ?>

</div>
