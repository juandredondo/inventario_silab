<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoFlujo */

$this->title = 'Create Tipo Flujo';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Flujos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-flujo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
