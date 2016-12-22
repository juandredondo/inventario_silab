<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\Marca;
use app\modules\inventario\models\TipoItem;

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
        "id"        => $formID,
        "action"    => Url::toRoute("items/" . Yii::$app->action)
    ]); ?>

    <input type="hidden" name="Item[HIDDEN_ID]" value="<?= $itemId ?>">

    <?= $form->field($model, 'ITEM_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ITEM_OBSERVACION')->textarea(['rows' => 6]) ?>

    <?= DropDownWidget::widget(
            [
                "form"  =>  $form,
                "model" =>  [
                    "main"  => $model,
                    "ref"   => Marca::className()
                ],
                "columns"   => [
                    "id"    =>  "MARC_ID",
                    "text"  =>  "MARC_NOMBRE"
                ]
            ]
        ); 
    ?>
    
    <?= DropDownWidget::widget(
            [
                "form"  =>  $form,
                "model" =>  [
                    "main"  => $model,
                ],
                "refData"   => TipoItem::find()->where(['not', ['TIIT_PADRE' => null]])->all(),
                "columns"   => [
                    "id"    =>  "TIIT_ID",
                    "text"  =>  "TIIT_NOMBRE"
                ],
                "options" => [ "disabled" => ($itemId !== null && $itemId !== "") ? true : false ]
            ]
        ); 
    ?>

    <div data-next-form-wrapper>
        <div class="content box card" id="items-next-form" >
            <div class="row">
                <div data-next-form class="col-md-12">
        
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

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
