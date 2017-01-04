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

    <?= $form->field($stock, 'PERI_ID')->dropDownList(
		     
            ArrayHelper::map(Periodo::find()->asArray()->all(), 'PERI_ID', 'PERI_FECHA'),
            ['prompt'=>'-Seleccione un periodo-'])
            
		?>

    <div class="form-group">
        <?= Html::submitButton($stock->isNewRecord ? 'Create' : 'Update', ['class' => $stock->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
