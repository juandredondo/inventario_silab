<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = 'Update Inventario: ' . $model->INVE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->INVE_ID, 'url' => ['view', 'id' => $model->INVE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inventario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
