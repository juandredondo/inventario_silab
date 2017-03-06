<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Pjax;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;

use app\assets\DataTablesAsset;
use app\assets\LaboratoryAsset;


// Registrar Asset para modulo inventario
DataTablesAsset::register($this);
LaboratoryAsset::register($this);

function checkPeriodo ($model)
{
    $periodo = $model->periodo;
    if($periodo !== null)
        return $periodo->esVigente() ? 
                "<span class='label label-success'>VIGENTE (" . $model->periodo->alias . ")</span>": 
                "<span class='label label-warning'>CADUCADO (" . $model->periodo->alias . ")</span>";
    else
        return $periodo;
}

$this->params[ "data.laboratory" ]  = $data[ "laboratory" ];
$this->params[ "count" ]            = count( $data[ "inventories" ] );
?>

<section class="content">    
        <?php 
            $dataProvider = new ArrayDataProvider([
                'allModels' => $data[ "inventories" ],
                'pagination' => [
                    'pageSize' => 6,
                ],
            ]);
            echo ListView::widget([
                "id"            => "inventories-list",
                'dataProvider'  => $dataProvider,
                'itemView'      => "@inventarioViews/inventario/" . ((Yii::$app->request->getQueryParam("view_mode", "list") == "list") ? '_list.php' : '_card.php'),
            ]);
        ?>
    
</section>


<?php 
    $this->registerJsFile(
        '@web/silab-vendor/js/silab-laboratory/laboratory.inventories.js',
        ['depends' => [LaboratoryAsset::className()]]
    );

    $this->registerJs("
        $(document).on('ready', alignCards);

        function alignCards()
        {
            console.log('aligned');
        }
    ");
?>

