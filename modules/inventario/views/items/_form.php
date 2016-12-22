<?php

use yii\helpers\Html;
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
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(); ?>

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
                ]
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

                $('select[name*=\"TIIT_ID\"]').on('change', function(){
                    var typeId  = $(this).val();
                    var item    = new silab.items();
                    // -- Load Form    
                    item.loadForm(typeId);
                });
            });"
        );
?>
