<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;
use app\modules\inventario\models\Stock;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = $model->INVE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-view">
<div class="row">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->INVE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Agregar item', ['stock/create', 'id' => $model->INVE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->INVE_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'INVE_ID',
            'nombre',
            'alias',
            'descripcion',
            'laboratorio.nombre',
            'periodo.alias',
        ],
    ]) ?>
<div class="col-md-12">
   <h3>Items del inventario</h3>
 <?php   
  
   $dataProvider = new ActiveDataProvider([
        'query' => Stock::find()->where(['INVE_ID' => $model->INVE_ID]),
        'pagination' => [
            'pageSize' => 4,
        ],
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
                'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'deta_id',
            //'pedi_id',
            'item.ITEM_NOMBRE',
            'item.marca.MARC_NOMBRE',
            'STOC_CANTIDAD',
            'periodo.PERI_FECHA',
            /*'plat.plat_descripcion',
            'deta_cantidad',
            'est.est_detalle',*/
            //'est_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?> 
</div>
</div>
</div>

<?php Modal::begin([
        "id"=>"ajaxCrudModal",
        "footer"=>"",// always need it for jquery plugin
    ])?>
<?php Modal::end(); ?>
