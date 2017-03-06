<?php
namespace app\components\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class DropDownWidget extends Widget
{
    public $prompt;
    public $label = null;
    public $form;
    public $model;
    public $columns;
    public $options = [];
    public $refData = null;

    public function init()
    {
        // 1. Llamada al iniciador pariente
        parent::init();
        // 2. Init promp
        $this->prompt   =  ($this->prompt !== null) ? $this->prompt : "Seleccione un item";
        if($this->form === null)
            throw new \yii\base\InvalidConfigException("la pripiedad \"form\" debe no puede ser nula");
        if($this->model === null)
            throw new \yii\base\InvalidConfigException("la pripiedad \"model\" debe no puede ser nula");
        if($this->columns === null)
            throw new \yii\base\InvalidConfigException("la pripiedad \"columns\" debe no puede ser nula");
        
        $this->options =  ($this->options !== null) ? $this->options : [];
        // $this->refData =  ($this->refData !== null) ? $this->refData : [];

    }

    public function run()
    {
        $data       = [];
        $prompt     = $this->prompt;
        $model      = $this->model;
        $form       = $this->form;
        $columns    = $this->columns;
        $options    = $this->options;
        $refData    = $this->refData;
        $label      = $this->label;

        $items      = ( isset($refData) ) ? ( !empty($refData) ? $refData : [] ) : $model[ "ref" ]::find()->all();

        if(isset($options))
            $options[ "prompt" ] = isset($options[ "propmt" ]) ? $options[ "prompt" ] : $prompt;
        
        if(isset($columns))
        {
            if(!isset($columns["attribute"]))
                $columns["attribute"] = $columns[ "id" ];
            
            if(!isset($label))
                $label = $model["main"]->getAttributeLabel($columns["id"]);

            if(isset($columns["id"]) && isset($columns["text"]))
                $data = ArrayHelper::map($items, $columns[ "id" ], $columns[ "text" ] );
        }

        if(isset($options["options"]["dataManager"])) {
            $options["options"] = $this->renderOptionsData($items, $options["options"]["dataManager"]);
        }

        if(is_object($form))
        {
            return $form->field($model[ "main" ], $columns["attribute"])->dropDownList(
                    $data,
                    $options
            )->label( $label );
        }
        else
        {  
            $options[ "class" ] = ["form-control", "select2"];
            $ref = new $model["ref"];

            $html =  "";
            if( $label !== false ) {
               $html .= Html::label( $label == "" ? $ref->getAttributeLabel(
                            isset($model["label"]) ? $model["label"] : $columns["text"])
                            : $label, 
                            isset($model["name"])  ? $model["name"]  : $columns["attribute"] 
                        ); 
            }
            
            $html .= Html::dropDownList ($columns["attribute"], null, 
                            $data,
                            $options
                    );

            return $html;
        }        
    }

    protected function renderOptionsData($items, $callback)
    {
        $result = [];

        foreach($items as $item) {
            if( is_callable($callback) ) {
                $result[ $item->id ] = call_user_func($callback, $item);
            }
        }

        return $result;

    }
}

?>