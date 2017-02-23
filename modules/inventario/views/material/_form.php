<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use Underscore\Underscore as _;

use app\components\ArrayHelperFilter;
/* @var $this yii\web\View */
/* @var $model app\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
    // variable para imprimir el boton tambien
    $submitButton   = (isset($submitButton))    ? $submitButton : true;  
    $isJustLoad     = (isset($isJustLoad))      ? $isJustLoad   : false;
    $isAjax         = isset($isAjax) ? $isAjax : false;

    $item           = $model->item;
    $itemConsumible = $model->parent;

    $actionName     = ( $model->isNewRecord ? "create" : "update" ) . ( $isAjax ? "-by-ajax" : "" );
    $actionConfig   = [ $actionName, "returnUrl" => ( isset($returnUrl) ?  $returnUrl : "" )];
    
    if( $model->id )
        $actionConfig[ "id" ] = $model->id;

    $action         = Url::toRoute( $actionConfig );

?>
<div class="material-form">

    <?php $form = ActiveForm::begin(["action" => $action, "id" => "item-material-form"]); ?>

    <?php 
        require Yii::getAlias("@inventarioViews").'/material/_form-fields.php';
    ?>

    <? 
        $fields = ArrayHelperFilter::move($fields, [
            "material-MATE_MEDIDA" => 2
        ]);

        _::each($fields, function($i){ echo $i; });
     ?>

    <?// $form->field($model, 'ITCO_ID')->textInput() ?>
    
    <?php if($submitButton): ?>
        <?= $this->render("@inventarioViews/items/_form-footer", [ "model" => $model ])?>
    <?php endIf; ?>

    <?php ActiveForm::end(); ?>

</div>
