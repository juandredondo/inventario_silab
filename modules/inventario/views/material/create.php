<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Material */

$this->title                    = 'Create Material';
$this->params['breadcrumbs'][]  = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][]  = $this->title;
$returnUrl                      = isset($returnUrl) ? $returnUrl : "";
?>
<div class="material-create content card">

    <?= $this->render('_form', [
        'model'         => $model,
        'returnUrl'     => $returnUrl,
        'submitButton'  => $submitButton,
        'formId'        => $formId,
        'itemId'        => $itemId
    ]) ?>

</div>
