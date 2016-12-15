<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Simbolo */

$this->title = $model->SIMB_ID;
$this->params['breadcrumbs'][] = ['label' => 'Simbolos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simbolo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->SIMB_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->SIMB_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'SIMB_ID',
            'SIMB_NOMBRE',
            'SIMB_CODIGO',
        ],
    ]) ?>

</div>
