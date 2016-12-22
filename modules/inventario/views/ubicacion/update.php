<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ubicacion */

$this->title = 'Update Ubicacion: ' . $model->UBIC_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ubicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UBIC_ID, 'url' => ['view', 'id' => $model->UBIC_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ubicacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
