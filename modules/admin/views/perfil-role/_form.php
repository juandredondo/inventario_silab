<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\ArrayHelperFilter;
use app\components\widgets\DropDownWidget;
use app\modules\admin\models\Permiso;
use app\modules\admin\models\Rol;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PerfilRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perfil-role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= DropDownWidget::widget([
            "form" => $form,
            "model" => [
                "main"  => $model,
                "ref"   => Rol::className()
            ],
            "columns" => [ "attribute" => "ROL_ID", "id" => "ROL_ID", "text" => "ROL_NOMBRE" ]
        ]);
    ?>

    <?= DropDownWidget::widget([
            "form" => $form,
            "model" => [
                "main"  => $model,
                "ref"   => Permiso::className()
            ],
            "columns" => [ "attribute" => "PERM_ID", "id" => "PERM_ID", "text" => "alias" ]
        ]);
    ?>
    <?php if(isset($parents)): ?>
    
        <?= DropDownWidget::widget([
                "form" => $form,
                "model" => [
                    "main"  => $model,
                    'ref'   => $model
                ],
                "refData" => $parents,
                "columns" => [ "attribute" => "PERO_PADRE", "id" => "PERO_ID", "text" => "alias" ]
            ]);
        ?>

    <?php endIf; ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
