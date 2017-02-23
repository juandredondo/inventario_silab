<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/*use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\Marca;
use app\modules\inventario\models\TipoItem;*/

use app\assets\InventarioAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Items */
/* @var $form yii\widgets\ActiveForm */

// Registrar Asset para modulo inventario
InventarioAsset::register($this);

$formID = "items-form";
?>

<div class="items-form">

    <?php $form = ActiveForm::begin([
            "id"                        => $formID,
            "enableClientValidation"    => true,
            "action"                    => Url::toRoute("items/" . Yii::$app->controller->action->id)
        ]); 
    ?>

    <input type="hidden" name="Items[HIDDEN_ID]" value="<?= $itemId ?>">

    <?php 
        require Yii::getAlias('@inventarioViews').'/items/_form-fields.php';
    ?>

    <div data-next-form-wrapper >
        <div class="content box card" id="items-next-form" >
            <div class="row">
                <div data-next-form class="col-md-12">   
                </div>
            </div>
        </div>
    </div>

    <?= $this->render("_form-footer", [ "model" => $item ])
    ?>
    <?php ActiveForm::end(); ?>
</div>

<?php 
    $this->registerJs("
            $(function(){
                var item        = new silab.items();
                    item.form   = $('#items-form');

                if($('select[name*=\"TIIT_ID\"]').val() != '')
                {
                    var typeId = $('select[name*=\"TIIT_ID\"]').val();

                    // Cambiar accion del formulario
                        item.cambiarAccion(typeId);
                    // Load Form    
                        item.loadForm({
                            itemType    :   typeId,
                            itemId      :   $('[name*=\"HIDDEN_ID\"]').val()
                        });
                }

                $('select[name*=\"TIIT_ID\"]').on('change', function(){
                    var typeId  = $(this).val();

                    // Cambiar accion del formulario
                        item.cambiarAccion(typeId);
                    // Load Form    
                        item.loadForm({
                            itemType: typeId
                        });
                });
            });"
        );
?>
