<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Permiso */
?>
<div class="permiso-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'PERM_ID',
            'PERM_ACCION',
            'PERM_CONTROLADOR',
            'PERM_MODULO',
            'padre.alias',
        ],
    ]) ?>

</div>
