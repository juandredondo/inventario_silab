<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LaboratorioConfig */

$this->title = 'Create Laboratorio Config';
$this->params['breadcrumbs'][] = ['label' => 'Laboratorio Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratorio-config-create content card">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
