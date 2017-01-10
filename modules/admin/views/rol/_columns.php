<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ROL_NOMBRE',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ROL_ORDEN',
    ],
    [
        'class'     => 'kartik\grid\ActionColumn',
        'dropdown'  => false,
        'vAlign'    =>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to(["rol/". $action,'id'=>$key]);
        },
        'viewOptions'=>['role'  =>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'¿Esta seguro?',
                          'data-confirm-message'=>'Esta seguro de borrar este rol, podria dejar varios usuarios sin acceso.'], 
    ],

];   