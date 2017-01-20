<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Accesorios */

$this->title = 'Update Accesorios: ' . $model->ACCE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Accesorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ACCE_ID, 'url' => ['view', 'id' => $model->ACCE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accesorios-update content card">

    <?= $this->render('_form', [
        'model'     => $model,
        'itemId'    => $itemId,
    ]) ?>

</div>
