<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title                    = 'Create Equipo';
$this->params['breadcrumbs'][]  = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][]  = $this->title;
$returnUrl                      = isset($returnUrl) ? $returnUrl : "";
?>
<div class="equipo-create  content card">

    <?= $this->render('_form', [
        'model'         => $model,
        'returnUrl'     => $returnUrl,
        'submitButton'  => $submitButton,
        'formId'        => $formId,
        'itemId'        => $itemId,
        'isAjax'        => $isAjax
    ]) ?>

</div>
