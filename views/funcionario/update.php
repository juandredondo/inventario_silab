<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */

$this->title = 'Update Funcionario: ' . $funcionario->FUNC_ID;
$this->params['breadcrumbs'][] = ['label' => 'Funcionarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $funcionario->FUNC_ID, 'url' => ['view', 'id' => $funcionario->FUNC_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="funcionario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'funcionario' => $funcionario,
        'persona' => $persona,
    ]) ?>

</div>
