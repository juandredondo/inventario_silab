<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Coordinador */

$this->title = 'Create Coordinador';
$this->params['breadcrumbs'][] = ['label' => 'Coordinadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coordinador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
