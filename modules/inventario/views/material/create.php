<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Material */

$this->title = 'Create Material';
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-create">
    <?php if($submitButton == true): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endIf; ?> 

    <?= $this->render('_form', [
        'model'         => $model,
        'submitButton'  => $submitButton,
        'formId'        => $formId,
        'item'          => $item,
        'itemId'        => $itemId,
    ]) ?>

</div>
