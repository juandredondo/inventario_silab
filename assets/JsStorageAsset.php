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
class JsStorageAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/js-storage';
    public $css = [ ];
    public $js = [
        'js.storage.min.js'
    ];

    public $depends = [       
    ];
}