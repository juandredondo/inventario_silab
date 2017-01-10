<?php 
    // Inventario aliases
    Yii::setAlias('@inventario',  __DIR__. '/../modules/inventario');
    Yii::setAlias('@admin',  __DIR__. '/../modules/admin');
    // - - - Items views
    Yii::setAlias("@inventarioViews", "@inventario/views");
    // - - - admin views
    Yii::setAlias("@adminViews", "@admin/views");
?>