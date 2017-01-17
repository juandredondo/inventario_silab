<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = 'Create Items';
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



?>
<div class="items-create content card">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'item'  => $item,
        'model' => isset($model) ? $model : null
    ]) ?>

</div>
