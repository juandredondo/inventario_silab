<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Permiso */
?>
<div class="permiso-update">

    <?= $this->render('_form', [
        'model'     => $model,
        'parents'   => $parents
    ]) ?>

</div>
