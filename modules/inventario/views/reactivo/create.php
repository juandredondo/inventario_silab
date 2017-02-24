<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reactivo */

$this->title                    = 'Create Reactivo';
$this->params['breadcrumbs'][]  = ['label' => 'Reactivos', 'url' => ['index']];
$this->params['breadcrumbs'][]  = $this->title;
$returnUrl                      = isset($returnUrl) ? $returnUrl : "";
$submitButton                   = isset($submitButton) || $submitButton = true;
$formId                         = isset($formId) ? $formId : null;
?>

<div class="reactivo-create content card">
    <?= $this->render('_form', [
        'model'         => $model,
        'returnUrl'     => $returnUrl,
        'submitButton'  => $submitButton,
        'formId'        => $formId,
        'isAjax'        => $isAjax
    ]) ?>

</div>
