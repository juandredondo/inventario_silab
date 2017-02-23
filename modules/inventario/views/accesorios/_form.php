<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use Underscore\Underscore as _;
/* @var $this yii\web\View */
/* @var $model app\models\Accesorios */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
    // variable para imprimir el boton tambien
    $submitButton       = (isset($submitButton))    ? $submitButton : true;  
    $isJustLoad         = (isset($isJustLoad))      ? $isJustLoad   : false;
    $isAjax             = isset($isAjax) ? $isAjax : false;

    $item               = $model->item;
    $itemNoConsumible   = $model->parent;

    $actionName         = ( $model->isNewRecord ? "create" : "update" ) . ($isAjax ? "-by-ajax" : "");
    $actionConfig       = [ $actionName, "returnUrl" => ( isset($returnUrl) ?  $returnUrl : "" )];
    
    if( $model->id )
        $actionConfig[ "id" ] = $model->id;

    $action         = Url::toRoute( $actionConfig );

?>
<div class="accesorios-form">

    <?php $form = ActiveForm::begin(["action" => $action, "id" => "item-accesory-form"]); ?>

    <?php 
        require Yii::getAlias("@inventarioViews").'/equipo/_form-fields.php';
    ?>

    <? 
        _::each($fields, function($i){ echo $i; });
     ?>

    

    <?php if($submitButton): ?>
        <?= $this->render("@inventarioViews/items/_form-footer", [ "model" => $model ])?>
    <?php endIf; ?>
    
    <?php ActiveForm::end(); ?>

</div>
