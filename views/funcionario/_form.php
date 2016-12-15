<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Tipoidentificacion;
use app\models\Genero;

/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funcionario-form">

    <?php $form = ActiveForm::begin(); ?> 

    
    <?= $form->field($persona, 'PERS_NOMBRE')->textInput() ?>
    <?= $form->field($persona, 'TIID_ID')->dropDownList(
		ArrayHelper::map(Tipoidentificacion::find()->asArray()->all(), 'TIID_ID', 'TIID_NOMBRE'),
        ['prompt'=>'-Seleccione un tipo de identificacion-'])
            
		?>
	<?= $form->field($persona, 'PERS_IDENTIFICACION')->textInput() ?>
	<?= $form->field($persona, 'GENE_ID')->dropDownList(
		ArrayHelper::map(Genero::find()->asArray()->all(), 'GENE_ID', 'GENE_NOMBRE'),
        ['prompt'=>'-Seleccione un genero-'])
            
		?>	

    <div class="form-group">
        <?= Html::submitButton($funcionario->isNewRecord ? 'Create' : 'Update', ['class' => $funcionario->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
