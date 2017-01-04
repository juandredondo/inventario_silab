<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reactivo */

$this->title = 'Update Reactivo: ' . $model->REAC_ID;
$this->params['breadcrumbs'][] = ['label' => 'Reactivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->REAC_ID, 'url' => ['view', 'id' => $model->REAC_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reactivo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
        'itemId'    => $itemId,
    ]) ?>

</div>
