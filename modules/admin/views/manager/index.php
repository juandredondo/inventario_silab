<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PermisoSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permisos';
$this->params['breadcrumbs'][] = "Manager";

CrudAsset::register($this);

?>

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#roles" aria-controls="home" role="tab" data-toggle="tab">Roles</a>
                </li>
                <li role="presentation">
                    <a href="#actions" aria-controls="profile" role="tab" data-toggle="tab">Acciones</a>
                </li>
                <li role="presentation">
                    <a href="#profile-roles" aria-controls="messages" role="tab" data-toggle="tab">Perfil de rol</a>
                </li>
                <li role="presentation" class="disabled">
                    <a href="#" aria-controls="settings" role="tab" data-toggle="tab">Cuentas</a>
                </li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="roles">
                    <div class="row">
                        <div class="col-md-12 ">
                            <?= 
                                Yii::$app->controller->renderPartial('/rol/index.php',  [
                                    'searchModel'   => $models[ 'rol' ]['searchModel'],
                                    'dataProvider'  => $models[ 'rol' ]['dataProvider'],
                                ]); 
                            ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="actions">
                    <div class="row">
                        <div class="col-md-12">
                            <?= 
                                Yii::$app->controller->renderPartial('/permiso/index.php',  [
                                    'searchModel'   => $models[ 'permiso' ]['searchModel'],
                                    'dataProvider'  => $models[ 'permiso' ]['dataProvider'],
                                ]); 
                            ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile-roles">
                    <div class="row">
                        <div class="col-md-12 ">
                            <?= 
                                Yii::$app->controller->renderPartial('/perfil-role/index.php',  [
                                    'searchModel'   => $models[ 'perfil' ]['searchModel'],
                                    'dataProvider'  => $models[ 'perfil' ]['dataProvider'],
                                ]); 
                            ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="accounts">
                    <div class="row">
                        <div class="col-md-12 card">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

