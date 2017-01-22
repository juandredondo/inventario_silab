
<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\inventario\models\core\EstadoConsumible;

?>


<h3 >Reporte de items consumibles.</h3><br>  
<?= Html::beginForm(
        Url::toRoute("item-consumible/rptestadoitems"),//action
        "get",//method
        ['class' => 'form-inline']//options
        );
?>

<div class="form-group">
    <?= Html::label("Estado: ", "ESCO_ID") ?>

<?= Html::dropDownList('ESCO_ID', null,
      ArrayHelper::map(EstadoConsumible::find()->all(), 'ESCO_ID', 'ESCO_NOMBRE')) ?>

</div>


<?= Html::submitInput("Aceptar", ["class" => "btn btn-primary",'target'=>'_blank']) ?>

<?= Html::endForm() ?>