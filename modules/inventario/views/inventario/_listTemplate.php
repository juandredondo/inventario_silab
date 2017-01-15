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

<div class="card clickable">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-2">
                    <p class ="text-center">
                        <i class="icon-middle material-icons md-32">hourglass_full</i>
                    </p>
                    <p class="text-center"><strong><%= model.isCaducaded %></strong></p>
                </div>
                <div class="col-md-8"></div>
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>