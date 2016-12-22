<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Rol */
?>
<div class="rol-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ROL_ID',
            'ROL_NOMBRE',
            'ROL_ORDEN',
        ],
    ]) ?>

</div>
