<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Flujo */

$this->title = 'Update Flujo: ' . $model->FLUJ_ID;
$this->params['breadcrumbs'][] = ['label' => 'Flujos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->FLUJ_ID, 'url' => ['view', 'id' => $model->FLUJ_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="flujo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
