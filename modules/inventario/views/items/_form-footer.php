<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Crear', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?= Html::button( 'Nuevo', [ "data" => [ "form-reseter" => null ], "id" => "reset-button", 'class' => 'btn btn-info']) ?>
</div>
