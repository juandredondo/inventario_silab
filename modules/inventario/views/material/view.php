<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\ArrayHelperFilter;
/* @var $this yii\web\View */
/* @var $model app\models\Material */

$this->title = $model->MATE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$item           = $model->item;
$itemConsumible = $model->parent;

$attributes = require (Yii::getAlias('@inventarioViews').'/item-consumible/_attributes.php');

?>
<div class="material-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
