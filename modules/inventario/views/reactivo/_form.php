<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use Underscore\Underscore as _;

use app\components\ArrayHelperFilter;
use app\components\widgets\DropDownWidget;

use app\modules\inventario\models\Ubicacion;
use app\modules\inventario\models\Unidad;
use app\modules\inventario\models\Simbolo;
/* @var $this yii\web\View */
/* @var $model app\models\Periodo */
/* @var $form yii\widgets\ActiveForm */
use app\assets\DatePickerAsset;
DatePickerAsset::register($this);
?>
<?php 
    // variable para imprimir el boton tambien
    $submitButton   = (isset($submitButton)) ? $submitButton : true;  
    $isJustLoad     = (isset($isJustLoad)) ? $isJustLoad : false;
    $isAjax         = isset($isAjax) ? $isAjax : false;

    $item           = $model->item;
    $itemConsumible = $model->parent;

    $actionName     = ( $model->isNewRecord ? "create" : "update" ) . ( $isAjax ? "-by-ajax" : "" );
    $actionConfig   = [ $actionName, "returnUrl" => ( isset($returnUrl) ?  $returnUrl : "" )];
    
    if( $model->id )
        $actionConfig[ "id" ] = $model->id;

    $action         = Url::toRoute( $actionConfig );
?>
<div class="reactivo-form">

    <?php 
        $form = ($formId === null) ? ActiveForm::begin(["action" => $action, "id" => "item-reactive-form" ]) : ActiveForm::begin([ "id" => $formId]); 
        require Yii::getAlias('@inventarioViews').'/reactivo/_form-fields.php';
    ?>

    <?php 
        $fields = ArrayHelperFilter::move($fields, [
            "reactivo-REAC_CODIGO" => 1,
            "reactivo-UNID_ID" => 4,
            "reactivo-SIMB_ID" => 5,
        ]);

        _::each($fields, function($i){
            echo $i;
        })
    ?>

    <?php if($submitButton): ?>
        <?= $this->render("@inventarioViews/items/_form-footer", [ "model" => $model ])?>
    <?php endIf; ?>

    <?php ActiveForm::end(); ?>

</div>

<?php 
        $this->registerJs("
            $(function(){

                $('input[name*=\"REAC_FECHA_VENCIMIENTO\"]').datepicker({
                    format: 'yyyy-mm-dd',
                });

            });"
        );
?>
