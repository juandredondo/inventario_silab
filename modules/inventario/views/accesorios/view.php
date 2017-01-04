<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\ArrayHelperFilter;
/* @var $this yii\web\View */
/* @var $model app\models\Accesorios */

$this->title = $model->ACCE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Accesorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$item               = $model->item;
$itemNoConsumible   = $model->parent;
$attributes         = require (Yii::getAlias('@inventarioViews').'/item-no-consumible/_attributes.php');

?>

<div class="accesorios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ACCE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ACCE_ID], [
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
            'ACCE_SERIAL',
            'ACCE_MODELO',
        ])
    ]) ?>

</div>
