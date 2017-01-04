<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Material */

$this->title = 'Update Material: ' . $model->MATE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MATE_ID, 'url' => ['view', 'id' => $model->MATE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="material-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
        'itemId'    => $itemId,
    ]) ?>

</div>
