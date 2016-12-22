<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoItem */

$this->title = 'Update Tipo Item: ' . $model->TIIT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TIIT_ID, 'url' => ['view', 'id' => $model->TIIT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
