<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Stock */

$this->title = 'Agregar item a inventario';
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create content card">
    <div class="row">
        <div class="col-md-6">
            <a href="#" data-toggle="modal" data-target="#item-modal" class="btn btn-flat btn-success">
                <i class="icon-bottom material-icons md-18">add_circle</i>
                <span class="hidden-xs hidden-sm">Registrar nuevo Item & agregar</span>
            </a>
            <button disabled class="btn btn-flat btn-default">Buscar</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                    'stock' => $stock,
                    'flujo' => $flujo,
            ]) ?>
        </div>
    </div>
</div>

<?php Modal::begin([
        "id"        => "item-modal",
        "size"      => Modal::SIZE_LARGE,
        "footer"    => "",// always need it for jquery plugin
    ])?>
    <?= $this->render("@inventarioViews/items/create", [ "returnUrl" => Url::toRoute([ '' ]) ]) ?>
<?php Modal::end(); ?>
