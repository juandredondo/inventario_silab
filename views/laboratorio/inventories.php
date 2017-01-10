<?php 

use yii\helpers\Html;
use yii\helpers\Url;
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

?>
<section class="content">
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
</section>

<?php 
    $this->registerJsFile(
        '@web/silab-vendor/js/silab-laboratory/laboratory.inventories.js',
        ['depends' => [LaboratoryAsset::className()]]
    );
?>

