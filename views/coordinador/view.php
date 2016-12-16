<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Coordinador */

$this->title = $model->persona->PERS_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Coordinadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coordinador-view"> 

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->COOR_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PERS_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'COOR_ID',
            'PERS_ID',
            'persona.PERS_NOMBRE',
            'persona.tipoIdentificacion.TIID_NOMBRE',
            'persona.PERS_IDENTIFICACION',
            'persona.genero.GENE_NOMBRE',
        ],
    ]) ?>

</div>
