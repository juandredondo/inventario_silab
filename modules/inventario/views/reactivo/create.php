<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reactivo */

$this->title = 'Create Reactivo';
$this->params['breadcrumbs'][] = ['label' => 'Reactivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reactivo-create content card">
    <?= $this->render('_form', [
        'model'         => $model,
        'submitButton'  => $submitButton,
        'formId'        => $formId,
        'itemId'        => $itemId
    ]) ?>

</div>
