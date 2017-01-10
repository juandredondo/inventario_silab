<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $ScriptVersion   = 1.0;
    public $basePath        = '@webroot';
    public $baseUrl         = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'silab-vendor/js/silab.app.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\UnderscoreAsset'
    ];

    // Agrego version del script
    private function getJs()
    {
        return [
            'silab-vendor/js/silab.app.js' . (($this->ScriptVersion != 0) ? ("?v=" .$this->ScriptVersion) : "")
        ];
    }

    public  function init()
    {
        parent::init();
        // Inicializo el arreglo de scripts
        $this->js = $this->getJs();
        // Forzar no cache
        $this->publishOptions['forceCopy'] = true;
    }
}
