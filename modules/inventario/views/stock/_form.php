<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\modules\inventario\models\core\Items;
use app\models\Periodo;

/* @var $this yii\web\View */
/* @var $model app\models\Stock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($stock, 'ITEM_ID')->dropDownList(
		     
            ArrayHelper::map(Items::find()->asArray()->all(), 'ITEM_ID', 'ITEM_NOMBRE'),
            ['prompt'=>'-Seleccione un item-'])
            
		?>
 	<?= $form->field($stock, 'INVE_ID')->textInput(
 		['type'=>'hidden','readonly' => false, 'value' => Yii::$app->request->get('id')])->label(false) ?>

         
    <?= $form->field($stock, 'STOC_CANTIDAD')->textInput(['type' => 'number']) ?>

    <div class="checkbox">
        <label>
        <input  type="checkbox"
                id="stock-manual-period"
                data-href="#collapse-period"
        > Agregar periodo manual
        </label>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>
                Por defecto, Silab Ionic mantiene la gestion de los periodos de cada inventario de manera automatica. 
                <em><b>Usa esta opcion si, quieres agregar manualmente el periodo de este stock para el item </b>
                <span class="label label-default" id="item-name"></span></em>
            </p>
        </div>
    </div>
    <input type="hidden" value="auto" name="manual-period">

    <div class="collapse" id="collapse-period">
        <div class="well">
            <?php 
                if($stock->isNewRecord)
                    $stock->PERI_ID = 1;
            ?>
            <?= $form->field($stock, 'PERI_ID')->dropDownList(      
                ArrayHelper::map(Periodo::find()->all(), 'PERI_ID', 'alias'),
                ['prompt'=>'-Seleccione un periodo-', "required" => false])
            ?>
        </div>
    </div>
    

    <div class="form-group">
        <?= Html::submitButton($stock->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $stock->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
    $this->registerJs("
        $(document).on('ready', main);

        function main()
        {
            $('#stock-manual-period').click(function(e){
                let me = $('input[name=\'manual-period\']');
                
                me.val( me.val() === 'auto' ? 'manual' : 'auto');
                
                $('#collapse-period').toggle();
            });

            $('select[name*=\'ITEM_ID\']').change(function(){
                let me   = $(this).children(':selected');
                let text = me.text();
                $('#item-name').text( text === '' ? 'X' : text );
            });
        }
    ");
?>
