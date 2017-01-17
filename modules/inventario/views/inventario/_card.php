<?php 

use yii\helpers\Html;
use yii\helpers\Url;

    $count = $this->params[ "count" ];
    
    if(isset($count) && !isset($manualSize))
    {
        $count = ( ($count % 2 == 0) && !($count % 3 == 0) ) ? 6 : 4;
    }
    else
    {
        
        $count = !isset($manualSize) ? 4 : $manualSize;
    }

    $laboratory = $this->params[ "data.laboratory" ];

?>


<div class="col-md-<?=$count?>">
    <div class="card clickable inventory-card">
        <div class="box-header with-border">
            <h3 class="box-title text-center"> 
                <b> 
                    <a href="<?= Url::toRoute(["/inventario/inventario/view", "id" => $model->INVE_ID]) ?>">
                        <i class="icon-bottom material-icons">view_module</i> 
                        <?= $model->INVE_NOMBRE ?>
                    </a>
                </b>
            </h3>
            <div class="box-tools pull-right">
                <!-- Single button -->
                <div class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class=" text-black icon-middle material-icons md-18">more_vert</i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= Url::toRoute(["/inventario/inventario/update", "lab" => $laboratory->LABO_ID,  "id" => $model->INVE_ID]) ?>"><i class="icon-bottom material-icons md-18">mode_edit</i> Editar</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <?= 
                                Html::a('<i class="icon-bottom material-icons md-18">remove_circle</i> Eliminar', 
                                    ['/inventario/inventario/delete', "id" => $model->INVE_ID, 'fromLaboratory' => true],
                                    [
                                        'data-method' => 'POST',
                                    ]
                                );
                            ?>
                            
                        </li>
                    </ul>
                </div>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-2">  
                    <i class="icon-middle material-icons text-orange md-48">business</i>                 
                </div>
                <div class="col-md-8">
                    <p>
                        <?= $model->INVE_DESCRIPCION?>
                    </p>
                    <p>
                        <b>PERIODO:</b> <?= checkPeriodo($model) ?>
                    </p>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <p class ="text-center">
                    <i class="icon-middle material-icons md-32">group_work</i>
                </p>
                <p class="text-center"><strong><?= count($model->items)  ?></strong></p>
                <p class="text-center">ITEMS</p>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <p class ="text-center">
                    <i class="icon-bottom fa-rotate-90 material-icons md-32 text-green">compare_arrows</i>
                </p>
                <p class="text-center text-green"><strong><?= count($model->entries)  ?></strong></p>
                <p class="text-center">ENTRADAS</p>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <p class ="text-center">
                    <i class="icon-bottom fa-rotate-90 material-icons md-32 text-red">compare_arrows</i>
                </p>
                <p class="text-center text-red"><strong><?= count($model->outs)  ?></strong></p>
                <p class="text-center">SALIDAS</p>
            </div>
        </div>
    </div>
</div>