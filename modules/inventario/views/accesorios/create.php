<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Accesorios */

$this->title = 'Create Accesorios';
$this->params['breadcrumbs'][] = ['label' => 'Accesorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accesorios-create">

    <?php if($submitButton == false): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endIf; ?> 

    <?= $this->render('_form', [
        'model' => $model,
        'submitButton' => $submitButton
    ]) ?>

</div>
