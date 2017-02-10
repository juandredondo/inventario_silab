<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\config\SilabConfig */

$this->title = 'Update Silab Config: ' . $model->SILAB_ID;
$this->params['breadcrumbs'][] = ['label' => 'Silab Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SILAB_ID, 'url' => ['view', 'id' => $model->SILAB_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="silab-config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
