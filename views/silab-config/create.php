<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\config\SilabConfig */

$this->title = 'Create Silab Config';
$this->params['breadcrumbs'][] = ['label' => 'Silab Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="silab-config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
