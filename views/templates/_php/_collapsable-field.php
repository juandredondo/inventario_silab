<div class="checkbox">
    <label>
    <input  type="checkbox"
            id="<?= $data[ "id" ] ?>"
            data-href="#<?=$data[ "target" ] ?>"
            data-collapsable-trigger
            data-form-field="[name*='<?= $data[ "field" ][ "name" ] ?>']"
            data-default-target="[name*='<?= $data[ "default" ][ "name" ] ?>']"
    > <?= $data[ "label" ] ?>
    </label>
</div>

<?php if( isset( $data[ "message" ] ) ): ?>
    <div class="row">
        <div class="col-md-12">
            <p>
                <?= $data[ "message" ] ?>
            </p>
        </div>
    </div>
<?php endIf; ?>

<input type="hidden" value="<?= $data[ "default" ][ "value" ] ?>"
    data-default-value="<?= $data[ "default" ][ "value" ] ?>" 
    data-default-off="<?= $data[ "default" ][ "off" ] ?>"
    name="<?= $data[ "default" ][ "name" ] ?>" >

<div class="collapse" id="<?= $data[ "target" ] ?>">
    <div class="well">
        <?= $data[ "field" ][ "html" ] ?>
    </div>
</div>
