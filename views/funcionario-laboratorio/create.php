<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\model\Funcionarios;

/* @var $this yii\web\View */
/* @var $model app\models\FuncionarioLaboratorio */

$this->title = 'Create Funcionario Laboratorio';
$this->params['breadcrumbs'][] = ['label' => 'Laboratorios', 'url' => ['laboratorio/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcionario-laboratorio-create col-md-6">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

<div class="col-md-6">
	<h1><?= Html::encode("Funcionarios ") ?></h1>
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
      'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'FULA_ID',
            'funcionario.persona.PERS_NOMBRE',
            'laboratorio.LABO_NOMBRE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
