<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Accesorios */

$this->title = 'Create Accesorios';
$this->params['breadcrumbs'][] = ['label' => 'Accesorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accesorios-create content card">

    <?= $this->render('_form', [
        'model'         => $model,
        'submitButton'  => $submitButton,
        'formId'        => $formId,
        'itemId'        => $itemId
    ]) ?>

</div>
