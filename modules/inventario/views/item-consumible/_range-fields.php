<?php 
use app\components as AppComponents;
use app\components\widgets\DropDownWidget;

use app\modules\inventario\models as InventoryModels;

?>
<?php 
    $ranges = $itemConsumible->ranges;

    if( !empty( $ranges ) ) : ?>
    <div class="row">
        <?php 
            $count  = count( $ranges );
            $colors = AppComponents\helpers\HotColor::generate( $count );

            foreach( $ranges as $i => $range )
            {
        ?>
            <div class="col-md-3">
                <?php 
                    echo $form->field( $range, "[{$i}]RACO_MIN", [
                        "template" => '{label}<div class="input-group">
                                <div class="label-hot bg-hot-' . round( ( $count - $i ) / $count * 100 ) . ' input-group-addon">
                                    ' . $range->estadoConsumible->ESCO_NOMBRE . '
                                </div>
                                {input}
                                </div>{hint}{error}'
                            
                    ])->textInput()->label(false);
                ?>    
            </div>
        <?php  
            }
        ?>
    </div>
<?php endIf; ?>

