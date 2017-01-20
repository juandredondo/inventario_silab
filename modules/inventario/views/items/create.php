<?php

use yii\helpers\Html;

use app\assets\InventarioAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = 'Registrar item';
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

InventarioAsset::register($this);
?>
<div class="items-create content card">
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <p>Escoja el tipo de item agregar, este desplegará un formulario valido de acuerdo al tipo.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="button-group">
                <div class="text-center">
                    <a  class="btn btn-success btn-flat btn-app"
                        data-role='form-loader' data-target="#form-cont" data-source="<?= Url::toRoute("/inventario/reactivo/loadform") ?>" >
                        <i class="text-blue fa fa-hourglass-end"></i> <span class="hidden-xs">REACTIVO</span>
                    </a>
                    <a class="btn btn-flat btn-app" data-role='form-loader' data-target="#form-cont" data-source="<?= Url::toRoute("/inventario/material/loadform") ?>" >
                        <i class="text-green fa fa-eyedropper"></i> <span class="hidden-xs">MATERIAL</span>
                    </a>
                    <a class="btn btn-flat btn-app" data-role='form-loader' data-target="#form-cont" data-source="<?= Url::toRoute("/inventario/equipo/loadform") ?>" >
                        <i class="text-red fa fa-laptop"></i> <span class="hidden-xs">EQUIPO</span>
                    </a>
                    <a class="btn btn-flat btn-app" data-role='form-loader' data-target="#form-cont" data-source="<?= Url::toRoute("/inventario/herramienta/loadform") ?>">
                        <i class="text-purple fa fa-gavel"></i> <span class="">HERRAMIENTA</span>
                    </a>
                    <a class="btn btn-flat btn-app" data-role='form-loader' data-target="#form-cont" data-source="<?= Url::toRoute("/inventario/accesorio/loadform") ?>" >
                        <i class="fa fa-laptop"></i> <span class="">ACCESORIO</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div id="form-cont" class="col-md-12">

        </div>
    </div>
</div>

<?php 
    $this->registerJs("
        silab.items.init();
    ");
?>


