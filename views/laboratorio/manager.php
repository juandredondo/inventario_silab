<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

use yii\helpers\Json;

use app\assets\DataTablesAsset;
use app\assets\LaboratoryAsset;

$this->title             = $data[ "laboratory" ]->LABO_NOMBRE;
$GLOBALS["data"]         = $data;
$this->params[ "count" ] = count( $data[ "inventories" ] );
// - - - - - - - - - - - - - - - -
LaboratoryAsset::register( $this );
?>

<script>
    var laboratoryId = <?= $data[ "laboratory" ]->LABO_ID; ?>

    var inventories = <?= Json::encode($data[ "inventories" ]) ?>;
</script>

<div class="content card">
    <div class="row">
        <div id="laboratory-alert-spot" class="col-md-12"></div>
    </div>
    <!-- Details from Laboratory -->
    <?= DetailView::widget([
        'model' => $data[ "laboratory" ],
        'attributes' => [
            'LABO_ID',
            'LABO_NOMBRE',
            'edificio.EDIF_NOMBRE',
            'coordinador.persona.PERS_NOMBRE',
            'tipolaboratorio.TILA_NOMBRE',
        ],
    ]) ?>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#inventories" aria-controls="home" role="tab" data-toggle="tab">Inventarios</a>
                    </li>
                    <li role="presentation">
                        <a href="#functionaries" aria-controls="profile" role="tab" data-toggle="tab">Funcionarios</a>
                    </li>
                    <li role="presentation">
                        <a href="#config" aria-controls="messages" role="tab" data-toggle="tab">Configuración (Actual)</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="inventories">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="btn-group pull-left">
                                        <?= Html::a('<i class="icon-bottom material-icons md-18">add</i> Agregar', ['inventario/inventario/create', 'lab' => $data[ "laboratory" ]->LABO_ID], ['class' => 'btn btn-success']) ?>
                                        </div>
                                        <div class="btn-group pull-right">
                                        <?php 
                                            $id        = Yii::$app->request->getQueryParam("id", 0);
                                            $alias     = Yii::$app->request->getQueryParam("alias", "");      
                                            $aliasOrId = [ 
                                                'key'   => "",
                                                'value' => ""
                                            ];

                                            if($id > 0)
                                                $aliasOrId = [ 'key'   => "id", 'value' => $id ];
                                            else if($alias !== "")
                                                $aliasOrId = [ 'key'   => "alias", 'value' => $alias ];
                                        ?>
                                         <?= Html::a('<i class="icon-bottom material-icons md-18">view_module</i>', ['', $aliasOrId[ "key" ] => $aliasOrId[ "value" ] , 'view_mode' => "card"], ['class' => 'btn btn-default']) ?>
                                        <?= Html::a('<i class="icon-bottom material-icons md-18">view_list</i>', ['', $aliasOrId[ "key" ] => $aliasOrId[ "value" ], 'view_mode' => "list"], ['class' => 'btn btn-default']) ?> 
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="inventories">
                                        <?php echo $this->render("inventories",
                                            [
                                                'data' => $data
                                            ]) 
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <script id="silab-template-card" type="text/template">
                                <?= $this->render("@inventarioViews/inventario/_cardTemplate.php") ?>
                            </script>
                            <script id="silab-template-list" type="text/template">
                                <?= $this->render("@inventarioViews/inventario/_cardTemplate.php") ?>
                            </script>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="functionaries">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="button-group">
                                    <?= Html::a('Agregar Funcionarios', ['funcionario-laboratorio/create', 'idLaboratorio' => $data[ "laboratory" ]->LABO_ID], ['class' => 'btn btn-success']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    $functionerProvider = new ArrayDataProvider([
                                        'allModels' => $data[ "functioners" ],
                                        'pagination' => [
                                            'pageSize' => 6,
                                        ],
                                    ]);
                                ?>            
                                <?= GridView::widget([
                                    'dataProvider' =>  $functionerProvider,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        'persona.PERS_NOMBRE',
                                        // 'laboratorio.LABO_NOMBRE',
                            
                                        ['class' => 'yii\grid\ActionColumn',
                                            'template' => '{view}{update}{delete}',
                                            'buttons'  =>
                                            [
                                                'view'=>function($model, $key,$url){
                                                        },
                                                'update'=>function($model, $key,$url){
                                                            $url=Yii::$app->urlManager->createUrl(['funcionario/update', 'id' => $key->FUNC_ID]);
                                                        },
                                                'delete'=>function($model, $key,$url){
                                                            $url=Yii::$app->urlManager->createUrl(['funcionario-laboratorio/delete', 'id' => $key->getAsignedByLaboratoryId($GLOBALS["data"]["laboratory"]->LABO_ID)->FULA_ID]);
                                                        return Html::a('<i class=" material-icons">remove_circle</i>', $url ,
                                                            [
                                                                'title' => \Yii::t('yii', 'Quitar funcionario'),
                                                            ]);    
                            
                                                        },
                                            ],
                                        ],
                                    ],
                                ]); ?>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="config">
                        <? 
                            $newConfig = $data[ "config" ]->isNewRecord;
                            echo $this->render("config/" . ( "create"), [
                                "model" => $data[ "config" ]
                            ]); 
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

