<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Simbolo */

$this->title = 'Update Simbolo: ' . $model->SIMB_ID;
$this->params['breadcrumbs'][] = ['label' => 'Simbolos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SIMB_ID, 'url' => ['view', 'id' => $model->SIMB_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="simbolo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
