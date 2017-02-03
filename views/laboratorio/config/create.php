<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LaboratorioConfig */
$title = "Parametros";
?>
<div class="laboratorio-config-create content card">
    <h1><?= Html::encode($title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
