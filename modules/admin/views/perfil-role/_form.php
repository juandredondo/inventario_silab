<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PerfilRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perfil-role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ROL_ID')->textInput() ?>

    <?= $form->field($model, 'PERM_ID')->textInput() ?>

    <?= $form->field($model, 'PERO_PADRE')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
