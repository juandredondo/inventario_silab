<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Edificio;
use app\models\Coodinador;
use app\models\TipoLaboratorio;

use app\components\widgets\DropDownWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Laboratorio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="laboratorio-form col-md-6">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'LABO_NOMBRE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LABO_NIVEL')->textInput() ?>

    <!-- estos campos pertenecen a la tabla edificios respectiamente mostrandolos como una lista desplegable -->
        <?= $form->field($model, 'EDIF_ID')->dropDownList(ArrayHelper::map(Edificio::find()->asArray()->all(), 'EDIF_ID', 'EDIF_NOMBRE'), ['prompt'=>'-Seleccione una opcion-'])?>
    
   <!-- estos campos pertenecen a la tabla coordinadores enlazando con la tabla personas respectiamente mostrandolos como una lista desplegable -->

     <?= $form->field($model, 'COOR_ID')->dropDownList(ArrayHelper::map(Edificio::findBySql("
        select
        TBL_PERSONAS.PERS_NOMBRE,
        TBL_COORDINADORES.COOR_ID
        FROM
        TBL_COORDINADORES
        INNER JOIN TBL_PERSONAS ON (TBL_COORDINADORES.PERS_ID = TBL_PERSONAS.PERS_ID)
         ")->asArray()->all(), 'COOR_ID', 'PERS_NOMBRE'), ['prompt'=>'-Seleccione una opcion-'])?>
    
    <!-- estos campos pertenecen a la tabla edificios respectiamente mostrandolos como una lista desplegable -->
    <?= $form->field($model, 'TILA_ID')->dropDownList(ArrayHelper::map(TipoLaboratorio::find()->asArray()->all(), 'TILA_ID', 'TILA_NOMBRE'), ['prompt'=>'-Seleccione una opcion-'])?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
