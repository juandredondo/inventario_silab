<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Herramienta */

$this->title                    = 'Create Herramienta';
$this->params['breadcrumbs'][]  = ['label' => 'Herramientas', 'url' => ['index']];
$this->params['breadcrumbs'][]  = $this->title;
$returnUrl                      = isset($returnUrl) ? $returnUrl : "";
?>
<div class="herramienta-create content card">

    <?= $this->render('_form', [
        'model'         => $model,
        'returnUrl'     => $returnUrl,
        'submitButton'  => $submitButton,
        'formId'        => $formId,
        'itemId'        => $itemId
    ]) ?>

</div>
