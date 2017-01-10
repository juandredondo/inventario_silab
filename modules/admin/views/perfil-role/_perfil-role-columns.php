<?php
use yii\helpers\Url;
use app\components\ArrayHelperFilter;
use app\modules\admin\models\Rol;
use kartik\grid\GridView;
return [
    [
        'class'     => 'kartik\grid\ExpandRowColumn',
        'value'     => function($model, $key, $index, $column){
            return GridView::ROW_COLLAPSED;
        },
        'detail'    => function($model, $key, $index)
        {
            $return = Yii::$app->controller->renderPartial(
                '/permiso/_detail-table.php', [
                    'model' => $model->permiso
                ]
            );
            
            return $return;
            
        }
    ],
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
        [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'PERO_ID',
    ],
    [
        'class'     =>'\kartik\grid\DataColumn',
        'attribute' =>'ROL_ID',
        'filter'    => ArrayHelperFilter::filter(
                        Rol::className(), 
                        ["value" => 'ROL_ID', "text" => 'ROL_NOMBRE' ]
                    ),
        'value'     => function($model, $widget)
        {
            return $model->rol->ROL_NOMBRE;
        }
    ],
    [
        'class'     =>  '\kartik\grid\DataColumn',
        'attribute' =>  'permiso.alias',
        'value'     =>  function($model, $widget)
        {
            return $model->alias;
        }
    ],
    [   
        'class'     =>'\kartik\grid\DataColumn',
        'attribute' =>'PERO_PADRE',
        'value'     => function($model, $widget)
        {
            return $model->padre->alias;
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to(["perfil-role/". $action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   