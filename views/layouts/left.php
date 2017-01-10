<?php 

use yii\helpers\Html;

if(!isset($this->params["main-side-menu"]))
    $this->params[ "main-side-menu" ] = require(__DIR__.'/_main-menu.php');
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= strtoupper( Yii::$app->user->identity->username ) ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <? 
            $menu = dmstr\widgets\Menu::widget(
                        $this->params[ "main-side-menu" ]
                    );
            echo $menu;
        ?>

    </section>

</aside>
