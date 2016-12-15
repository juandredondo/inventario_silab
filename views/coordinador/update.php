<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Coordinador */

$this->title = 'Update Coordinador: ' . $coordinador->COOR_ID;
$this->params['breadcrumbs'][] = ['label' => 'Coordinadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $coordinador->COOR_ID, 'url' => ['view', 'id' => $coordinador->COOR_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="coordinador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'coordinador' => $coordinador,
        'persona' => $persona,
    ]) ?>

</div>
