<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;

use app\assets\DataTablesAsset;
use app\assets\LaboratoryAsset;
$this->title = $data[ "laboratory" ]->LABO_NOMBRE;
?>

<div class="nav-tabs-custom">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#inventories" aria-controls="home" role="tab" data-toggle="tab">Inventarios</a>
    </li>
    <li role="presentation">
        <a href="#functionaries" aria-controls="profile" role="tab" data-toggle="tab">Funcionarios</a>
    </li>
    <li role="presentation">
        <a href="#dependencies" aria-controls="messages" role="tab" data-toggle="tab">Dependencias</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="inventories">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <form class="" action="#">
                        
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="inventories">
                    <?= $this->render("inventories",
                    [
                        'data' => $data
                    ]) ?>
                </div>
            </div>
        </div>
        <script id="silab-template-card" type="text/template">
            <?= $this->render("@inventarioViews/inventario/_cardTemplate.php") ?>
        </script>
        <script id="silab-template-list" type="text/template">
            <?= $this->render("@inventarioViews/inventario/_cardTemplate.php") ?>
        </script>
    </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="functionaries">
    </div>
    <div role="tabpanel" class="tab-pane" id="dependencies">
    </div>
  </div>

</div>

