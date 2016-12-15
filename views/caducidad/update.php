<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Caducidad */

$this->title = 'Update Caducidad: ' . $model->CADU_ID;
$this->params['breadcrumbs'][] = ['label' => 'Caducidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CADU_ID, 'url' => ['view', 'id' => $model->CADU_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="caducidad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
