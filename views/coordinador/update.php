<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Coordinador */

$this->title = 'Update Coordinador: ' . $model->COOR_ID;
$this->params['breadcrumbs'][] = ['label' => 'Coordinadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->COOR_ID, 'url' => ['view', 'id' => $model->COOR_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="coordinador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
