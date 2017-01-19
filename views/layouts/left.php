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
                <img src="<?php echo $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>
                    <i class="icon-bottom material-icons md-18 md-light">account_circle</i>
                    <span class="text"><?= strtoupper( Yii::$app->user->identity->username ) ?> </span>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?= !Yii::$app->user->isGuest ? "Online" : "Offline" ?></a>
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

        <?php 
            $menu = dmstr\widgets\Menu::widget(
                        $this->params[ "main-side-menu" ]
                    );
            echo $menu;
        ?>

    </section>

</aside>
