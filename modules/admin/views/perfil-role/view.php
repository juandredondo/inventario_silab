<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PerfilRole */
?>
<div class="perfil-role-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'PERO_ID',
            'ROL_ID',
            'PERM_ID',
            'PERO_PADRE',
        ],
    ]) ?>

</div>
