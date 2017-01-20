<?php 

use yii\helpers\Html;
use yii\helpers\Url;

$count = $this->params[ "count" ];

if(isset($count))
{
    $count = ( ($count % 2 == 0) && !($count % 3 == 0) ) ? 6 : 4;
}
else
{
    $count = 4;
}

?>

<div class="row">
    <div class="col-md-12 card clickable">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <p class="text-justified">
                    <a href="<?= Url::toRoute(["/inventario/inventario/view", "id" => $model->INVE_ID]) ?>">
                        <b> 
                            <i class="icon-bottom material-icons">view_module</i> <?= $model->INVE_NOMBRE ?>
                        </b>
                    </a>
                </p>
                <p class="text-center">
                    <?= checkPeriodo($model) ?>
                </p>
            </div>
            <div class="col-md-3 col-sm-3">
                <p class="text-center"><strong><?= count($model->items)  ?></strong></p>
                <p class="text-center">ITEMS</p>
            </div>
            <div class="col-md-3 col-sm-3">
                <p class="text-center text-green"><strong><?= count($model->entries)  ?></strong></p>
                <p class="text-center">ENTRADAS</p>
            </div>
            <div class="col-md-3 col-sm-3">
                <p class="text-center text-red"><strong><?= count($model->outs)  ?></strong></p>
                <p class="text-center">SALIDAS</p>
            </div>
        </div>
        <p class="text-justified">
            <!-- <?
                $itemsCount = $model->itemsStatistics;
                $count      = count($itemsCount);
                $html       = "";
                $size       = $count < 5? 3: 2;
            
                for($i = 0; $i < $count; $i++) 
                {
                    
                }
                echo \yii\helpers\Json::encode($counts);
            ?> -->
        </p>
    </div>
    
</div>