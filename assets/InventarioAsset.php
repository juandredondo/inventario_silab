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
class InventarioAsset extends AssetBundle
{
    private $version = 1.0;
    public $sourcePath = '@app/modules/inventario/vendor';
    public $css = [
        
    ];
    public $js = [];

    public $depends = [       
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    // Agrego version del script
    private function getJs()
    {
        return [
            'js/items.js' . (($version != 0) ? ("?v=" .$version) : "")
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