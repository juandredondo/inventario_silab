<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\ArrayHelperFilter;

use app\modules\inventario\models\Caducidad;
/* @var $this yii\web\View */
/* @var $model app\models\Reactivo */

$this->title = $model->item->ITEM_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => 'Reactivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$item           = $model->item;
$itemConsumible = $model->parent;

$attributes = require (Yii::getAlias('@inventarioViews').'/item-consumible/_attributes.php');

function checkCaducado($model)
{
    $caducidades = [
        Caducidad::Vigente          => "<span class='inline-block label label-success'><i class='icon-bottom material-icons md-18'>hourglass_full</i> VIGENTE</span>",
        Caducidad::ProximoVencer    => "<span class='inline-block label label-warning'><i class='icon-bottom material-icons md-18'>hourglass_full</i> PROXIMO A VENCER</span>",
        Caducidad::Vencido          => "<span class='inline-block label label-danger'><i class='icon-bottom material-icons md-18'>hourglass_empty</i> VENCIDO</span>"
    ];

    return $caducidades[ $model->caducidad->CADU_ID ];
            
}

?>
<div class="reactivo-view content card">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->REAC_ID], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->REAC_ID], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => ArrayHelperFilter::merge($attributes, [
            'REAC_ID',
            'REAC_CODIGO',
            'unidad.UNID_NOMBRE',
            'REAC_FECHA_VENCIMIENTO',
            'ubicacion.UBIC_CODIGO',
            [
                'attribute' => 'CADU_ID',
                'format'    => 'html',
                'value'     => checkCaducado($model)
            ],
            'SIMB_ID',
        ])
    ]) ?>

</div>
