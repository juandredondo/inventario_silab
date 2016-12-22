<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reactivo */

$this->title = 'Create Reactivo';
$this->params['breadcrumbs'][] = ['label' => 'Reactivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reactivo-create">

    <?php if($submitButton == false): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endIf; ?> 

    <?= $this->render('_form', [
        'model'         => $model,
        'submitButton'  => $submitButton,
        'formId'        => $formId,
        'itemId'        => $itemId
    ]) ?>

</div>
