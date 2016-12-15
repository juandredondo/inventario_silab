<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AuditLog */

$this->title = 'Create Audit Log';
$this->params['breadcrumbs'][] = ['label' => 'Audit Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audit-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
