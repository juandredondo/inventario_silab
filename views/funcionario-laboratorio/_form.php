<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Funcionario;

/* @var $this yii\web\View */
/* @var $model app\models\FuncionarioLaboratorio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funcionario-laboratorio-form">

    <?php $form = ActiveForm::begin(); ?>
	
	    <?= $form->field($model, 'LABO_ID')->textInput(['type'=>'','readonly' => true, 'value' => Yii::$app->request->get('idLaboratorio')])->label('N° Laboratorio ') ?>

	    <?= $form->field($model, 'FUNC_ID')->dropDownList(ArrayHelper::map(Funcionario::findBySql("
        select
        TBL_PERSONAS.PERS_NOMBRE,
        TBL_FUNCIONARIOS.FUNC_ID
        FROM
        TBL_FUNCIONARIOS
        INNER JOIN TBL_PERSONAS ON (TBL_FUNCIONARIOS.PERS_ID = TBL_PERSONAS.PERS_ID) where TBL_FUNCIONARIOS.FUNC_ID not in (select FUNC_ID from TBL_FUNCIONALABORATORIO )

         ")->asArray()->all(), 'FUNC_ID', 'PERS_NOMBRE'), ['prompt'=>'-Seleccione una opcion-'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
