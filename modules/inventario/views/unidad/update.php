<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\inventario\models\Unidad */

$this->title = 'Update Unidad: ' . $model->UNID_ID;
$this->params['breadcrumbs'][] = ['label' => 'Unidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UNID_ID, 'url' => ['view', 'id' => $model->UNID_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unidad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
