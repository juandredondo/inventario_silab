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
class SliderRangeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/bootstrap-slider';
    public $css = [
        'slider.css',
    ];
    public $js = [
        'bootstrap-slider.js'
    ];

    public $depends = [       
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
