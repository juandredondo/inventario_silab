<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\ArrayHelperFilter;
use app\components\widgets\AlertDimissible;
/* @var $this yii\web\View */
/* @var $model app\models\Material */

$this->title = $model->MATE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$item           = $model->item;
$itemConsumible = $model->parent;

$attributes = require (Yii::getAlias('@inventarioViews').'/item-consumible/_attributes.php');

?>
<div class="material-view content card">

    <div class="row">
        <div id="item-alert-spot" class="col-md-12">
            <?php 
                echo AlertDimissible::widget();
            ?>
        </div>
    </div>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->MATE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->MATE_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => ArrayHelperFilter::merge($attributes, [
            'MATE_ID',
            'MATE_MEDIDA'
        ])
    ]) ?>

</div>
