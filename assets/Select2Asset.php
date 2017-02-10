<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Jeancarlo Fontalvo
 * @since 1.0
 */
class Select2Asset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/select2';
    public $css = [
        'select2.min.css',
    ];
    public $js = [
        'select2.full.min.js'
    ];

    public $depends = [       
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
