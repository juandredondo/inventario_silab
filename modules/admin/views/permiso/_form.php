<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\modules\admin\models\Permiso;
use app\components\widgets\DropDownWidget;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Permiso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permiso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PERM_ACCION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PERM_CONTROLADOR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PERM_MODULO')->textInput(['maxlength' => true]) ?>
    
    <?= DropDownWidget::widget([
            "form" => $form,
            "model" => [
                "main"  => $model,
                "ref"   => Permiso::className()
            ],
            "refData" => $parents,
            "columns" => [ "attribute" => "PERM_PADRE", "id" => "PERM_ID", "text" => "alias" ]
        ]);
    ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
