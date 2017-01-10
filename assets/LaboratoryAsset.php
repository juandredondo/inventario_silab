<?php 
    
namespace app\assets;
use yii\web\AssetBundle;

class LaboratoryAsset extends  AssetBundle
{
    public $sourcePath = '@webroot/silab-vendor';
    public $css = [
        'css/silab.css'
    ];
    public $js = [
        'js/silab-laboratory/silab.laboratory.js'
    ];

    public $depends = [
        'app\assets\AppAsset'
    ];

    public function init()
    {
        parent::init();
        // Forzar no cache
        $this->publishOptions['forceCopy'] = true;
    }
}


?>