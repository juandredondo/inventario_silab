<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\inventario\models\Unidad */

$this->title = 'Create Unidad';
$this->params['breadcrumbs'][] = ['label' => 'Unidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
