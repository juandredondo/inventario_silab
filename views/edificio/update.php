<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Edificio */

$this->title = 'Update Edificio: ' . $model->EDIF_ID;
$this->params['breadcrumbs'][] = ['label' => 'Edificios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->EDIF_ID, 'url' => ['view', 'id' => $model->EDIF_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="edificio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
