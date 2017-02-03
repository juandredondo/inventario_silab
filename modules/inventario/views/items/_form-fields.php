<?php 
    // Campos comunes de items
use app\components\widgets\DropDownWidget;
use app\modules\inventario\models\Marca;
use app\modules\inventario\models\core\TipoItem;
?>

    <?= $form->field($item, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($item, 'observacion')->textarea(['rows' => 6]) ?>

    <?= DropDownWidget::widget(
            [
                "form"  =>  $form,
                "model" =>  [
                    "main"  => $item,
                    "ref"   => Marca::className()
                ],
                "columns"   => [
                    "id"    =>  "MARC_ID",
                    "text"  =>  "MARC_NOMBRE"
                ]
            ]
        ); 
    ?>
    
    <? 
        $tipoItemInput = "";

        if(isset($item->TIIT_ID)) 
        {
            $tipoItemInput = $form->field($item, 'TIIT_ID')->textInput(["type" => "hidden"])->label(false);
        }
        else {
            $tipoItemInput =    DropDownWidget::widget(
                                    [
                                        "form"  =>  $form,
                                        "model" =>  [
                                            "main"  => $item,
                                        ],
                                        "refData"   => TipoItem::find()->where(['not', ['TIIT_PADRE' => null]])->all(),
                                        "columns"   => [
                                            "id"    =>  "TIIT_ID",
                                            "text"  =>  "TIIT_NOMBRE"
                                        ],
                                        "options" => [ "disabled" => ($itemId !== null && $itemId !== "") ? true : false ]
                                    ]
                                ); 
        }

        echo $tipoItemInput;
    ?>