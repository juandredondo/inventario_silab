<div class="row">
    <div class="col-md-6">
        <?= $form->field($itemConsumible, 'ITCO_MIN')->textInput(['maxlength' => true, "type" => "number", "min" => $silabConfig->SILAB_STOCK_MIN ]) ?>
        <p class="text-justify" >El stock minimo que se necesita para operar en los laboratorios -<em> si no se especifica </em>- se 
            tomará el valor por defecto en la configuracion del aplicativo
        </p>
        <p style="font-size: 18px">
                <span class="label label-danger full-block">MINIMO <span id="min-amount" ><?= $silabConfig->SILAB_STOCK_MIN ?></span> </span>
                <input data-default="<?= $silabConfig->SILAB_STOCK_MIN ?>" type="hidden" name="stock-min" id="item-stock-min" value="<?= $silabConfig->SILAB_STOCK_MIN ?>" />
        </p>
    </div>
    <div class="col-md-6">
        <?= $form->field($itemConsumible, 'ITCO_MAX')->textInput(['maxlength' => true, "type" => "number", "max" => $silabConfig->SILAB_STOCK_MAX ]) ?>
        <p class="text-justify" >El stock maximo que se podrá administrar de este reactivo -<em> si no se especifica </em>- se 
            tomará el valor por defecto en la configuracion del aplicativo
        </p>
        <p style="font-size: 18px">
                <span class="label label-warning full-block">MAXIMO <span id="max-amount" ><?= $silabConfig->SILAB_STOCK_MAX ?></span></span>
                <input data-default="<?= $silabConfig->SILAB_STOCK_MAX ?>" type="hidden" name="stock-max" id="item-stock-max" value="<?= $silabConfig->SILAB_STOCK_MAX ?>" />
        </p>
    </div>
</div>