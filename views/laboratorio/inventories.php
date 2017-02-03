<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;

use app\assets\DataTablesAsset;
use app\assets\LaboratoryAsset;


// Registrar Asset para modulo inventario
DataTablesAsset::register($this);
LaboratoryAsset::register($this);

function checkPeriodo ($model)
{
    $periodo = $model->periodo;
    if($periodo !== null)
        return $periodo->esVigente() ? 
                "<span class='label label-success'>VIGENTE (" . $model->periodo->alias . ")</span>": 
                "<span class='label label-warning'>CADUCADO (" . $model->periodo->alias . ")</span>";
    else
        return $periodo;
}

$this->params[ "data.laboratory" ]  = $data[ "laboratory" ];
$this->params[ "count" ]            = count( $data[ "inventories" ] );
?>

<section class="content">
    <!--   
    <div class="row">
        <div class="col-md-12">
            <table id="table-inventories" class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Vigente</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                        <?php 
                            foreach($data[ "inventories" ] as $inventory)
                            { 
                        ?>
                            <tr data-row="<?= $inventory->INVE_ID ?>">
                                <td><?= $inventory->INVE_NOMBRE ?> </td>
                                <td><?= $inventory->INVE_DESCRIPCION ?> </td>
                                <td><?= checkPeriodo($inventory) ?> </td>
                                <td><button data-parent="<?= $inventory->INVE_ID ?>" data-role="row-expander" class="btn btn-xs btn-default"><i class="fa fa-plus"></i></button></td>
                            </tr>  
                                    
                        <?php   
                            }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    -->
    <div class="row">
        <div class="col-md-12">
            <?php 
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $data[ "inventories" ],
                    'pagination' => [
                        'pageSize' => 6,
                    ],
                ]);
                echo ListView::widget([
                    'dataProvider'  => $dataProvider,
                    'itemView'      => "@inventarioViews/inventario/" . ((Yii::$app->request->getQueryParam("view_mode", "list") == "list") ? '_list.php' : '_card.php'),
                ]);
            ?>
        </div>
    </div>
</section>


<?php 
    $this->registerJsFile(
        '@web/silab-vendor/js/silab-laboratory/laboratory.inventories.js',
        ['depends' => [LaboratoryAsset::className()]]
    );

    $this->registerJs("
        $(document).on('ready', alignCards);

        function alignCards()
        {
            console.log('aligned');
        }
    ");
?>

