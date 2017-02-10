<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\components\widgets\DropDownWidget;

use app\models\Laboratorio;
use app\models\Periodo;
/* @var $this yii\web\View */
/* @var $model app\models\InventarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'INVE_ID') ?>

    <?= DropDownWidget::widget([
        'form'      => $form,
        'model'     => [
            "main"  => $model,
            "ref"   => Laboratorio::className()
        ],
        "columns"   => [ "attribute" => 'LABO_ID', "id" => "id", "text" => "nombre" ],
        'options'   => [
            'disabled' => $readOnly
        ]
    ])  ?>


    <? //$form->field($model, 'INVE_CANTIDAD') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
