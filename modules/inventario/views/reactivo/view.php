<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\ArrayHelperFilter;
/* @var $this yii\web\View */
/* @var $model app\models\Reactivo */

$this->title = $model->REAC_ID;
$this->params['breadcrumbs'][] = ['label' => 'Reactivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$item           = $model->item;
$itemConsumible = $model->parent;

$attributes = require (Yii::getAlias('@inventarioViews').'/item-consumible/_attributes.php');
?>
<div class="reactivo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->REAC_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->REAC_ID], [
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
            'REAC_ID',
            'REAC_CODIGO',
            'REAC_UNIDAD',
            'REAC_FECHA_VENCIMIENTO',
            'UBIC_ID',
            'CADU_ID',
            'SIMB_ID',
        ])
    ]) ?>

</div>
