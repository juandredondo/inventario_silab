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

?>

<div class="col-md-<?= $count ?> col-xs-12 col-sm-12">
    <div class="card clickable inventory-card">
        <div class="box-header with-border">
            <h3 class="box-title text-center"> 
                <b> 
                    <a 
                        <% if(typeof data !== "undefined") { 
                            _.each(data.link, function(i){ %>
                            <%= "data-" + i  %>
                        <% }) 
                        } %>  
                       
                        href="<?= Url::toRoute(["/inventario/inventario/view", "id" => ""])?><%= model.id %>&partial=1&laboratory=<%= model.laboratoryId%>">
                        <i class="icon-bottom material-icons">view_module</i> 
                        <%= model.name %>
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
                        <li><a href="<?= Url::toRoute(["/inventario/inventario/update", "id" => ""])?><%= model.id %>"><i class="icon-bottom material-icons md-18">mode_edit</i> Editar</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="<?= Url::toRoute(["/inventario/inventario/delete", "id" => ""])?><%= model.id %>&fromLaboratory=1" data-method='POST'>
                                <i class="icon-bottom material-icons md-18">remove_circle</i> Eliminar
                            </a>
                            
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
                        <%= model.description %>
                    </p>
                    <p>
                        <b>PERIODO:</b> <%= model.isCaducated %>
                    </p>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <div class="col-md-4">
                <p class ="text-center">
                    <i class="icon-middle material-icons md-32">group_work</i>
                </p>
                <p class="text-center"><strong><%= model.itemsCount  %></strong></p>
                <p class="text-center">ITEMS</p>
            </div>
            <div class="col-md-4">
                <p class ="text-center">
                    <i class="icon-bottom fa-rotate-90 material-icons md-32 text-green">compare_arrows</i>
                </p>
                <p class="text-center text-green"><strong><%= model.entriesCount  %></strong></p>
                <p class="text-center">ENTRADAS</p>
            </div>
            <div class="col-md-4">
                <p class ="text-center">
                    <i class="icon-bottom fa-rotate-90 material-icons md-32 text-red">compare_arrows</i>
                </p>
                <p class="text-center text-red"><strong><%= model.outsCount  %></strong></p>
                <p class="text-center">SALIDAS</p>
            </div>
        </div>
    </div>
</div>