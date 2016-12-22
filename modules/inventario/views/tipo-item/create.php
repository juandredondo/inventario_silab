<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoItem */

$this->title = 'Create Tipo Item';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
