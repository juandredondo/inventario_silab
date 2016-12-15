<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Caducidad */

$this->title = 'Create Caducidad';
$this->params['breadcrumbs'][] = ['label' => 'Caducidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caducidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
