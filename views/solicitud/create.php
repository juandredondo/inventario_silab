<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Solicitud */

$this->title = 'Create Solicitud';
$this->params['breadcrumbs'][] = ['label' => 'Solicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-create content card">

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
        'detailItems' => $detailItems,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
