<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Simbolo */

$this->title = 'Create Simbolo';
$this->params['breadcrumbs'][] = ['label' => 'Simbolos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simbolo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
