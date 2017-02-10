<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reactivo */

$this->title                    = 'Create Reactivo';
$this->params['breadcrumbs'][]  = ['label' => 'Reactivos', 'url' => ['index']];
$this->params['breadcrumbs'][]  = $this->title;
$returnUrl                      = isset($returnUrl) ? $returnUrl : "";
?>
<div class="reactivo-create content card">
    <?= $this->render('_form', [
        'model'         => $model,
        'returnUrl'     => $returnUrl,
        'submitButton'  => $submitButton,
        'formId'        => $formId,
        'itemId'        => $itemId
    ]) ?>

</div>
