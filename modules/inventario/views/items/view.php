<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = $item->ITEM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attributes = require (Yii::getAlias('@inventarioViews').'/items/_attributes.php');

?>
<div class="items-view content card">
    <div class="row">
        <div id="item-alert-spot" class="col-md-12">
            <?php 
                echo AlertDimissible::widget();
            ?>
        </div>
    </div>
    <p>
        <?= Html::a('Update', ['update', 'id' => $item->ITEM_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $item->ITEM_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $item,
        'attributes' => $attributes,
    ]) ?>

</div>
