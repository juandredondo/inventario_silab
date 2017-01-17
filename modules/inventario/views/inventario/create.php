<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = 'Agregar inventario';
$this->params['breadcrumbs'][] = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-create content card">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
