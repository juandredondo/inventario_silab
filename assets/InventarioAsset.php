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
        'app\assets\AppAsset',
    ];

    // Agrego version del script
    private function getJs()
    {
        return [
            'js/items.js' . ( ($this->version != 0) ? ("?v=" . $this->version) : ""),
            'js/silab-inventory/silab.inventory.items.js' . ( ($this->version != 0) ? ("?v=" . $this->version) : "" ),
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