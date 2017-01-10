<?php 

?>
<div class="container">
    <div class="row">
        <div class="card col-md-8 col-md-offset-2">
            <table class="table-hover table table-responsive table-stripped">
                <thead>
                    <tr>
                        <th>Accion</th>
                        <th>Controlador</th>
                        <th>Modulo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $model->PERM_ACCION ?></td>
                        <td><?= $model->PERM_CONTROLADOR ?></td>
                        <td><?= $model->PERM_MODULO ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>