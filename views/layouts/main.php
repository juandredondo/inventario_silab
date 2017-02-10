<?php
use yii\helpers\Html;
use app\assets\SliderRangeAsset;
use app\assets\Select2Asset;
use app\assets\JsStorageAsset;
/* @var $this \yii\web\View */
/* @var $content string */

JsStorageAsset::register($this);

if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }
    app\assets\MaterialIconsAsset::register($this);
    Select2Asset::register($this);
    SliderRangeAsset::register($this);

    dmstr\web\AdminLteAsset::register($this);
    

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script id="templates" type="text/template">
            <templates>
                <?= require(Yii::getAlias("@app") . "/views/templates/_alert-dimissible.html") ?>
            </templates>
        </script>
    </head>
    <body class="hold-transition skin-yellow sidebar-mini layout-boxed" data-domain="<?= \yii\helpers\Url::base()?>">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= 
            $this->render(
                'header.php',
                ['directoryAsset' => $directoryAsset]
            ) 
        ?>
        
        <?= $this->render(
            'left.php',
            [
                'directoryAsset' => $directoryAsset,
            ]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'module' => Yii::$app->controller->module->id, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
