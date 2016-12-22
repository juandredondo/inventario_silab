<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Herramienta */

$this->title = 'Create Herramienta';
$this->params['breadcrumbs'][] = ['label' => 'Herramientas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="herramienta-create">

    <?php if($submitButton == false): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endIf; ?> 

    <?= $this->render('_form', [
        'model' => $model,
        'submitButton' => $submitButton
    ]) ?>

</div>
