<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\ArrayHelperFilter;
/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = $model->EQUI_ID;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$item               = $model->item;
$itemNoConsumible   = $model->parent;
$attributes         = require (Yii::getAlias('@inventarioViews').'/item-no-consumible/_attributes.php');

?>
<div class="equipo-view  content card">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->EQUI_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->EQUI_ID], [
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
            'EQUI_ID',
            'EQUI_SERIAL',
        ])
    ]) ?>

</div>
