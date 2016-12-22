<?php
namespace app\components\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class DropDownWidget extends Widget
{
    public $prompt;
    public $form;
    public $model;
    public $columns;
    public $options = [];
    public $refData = [];

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
        $this->refData =  ($this->refData !== null) ? $this->refData : [];
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

        if(isset($options))
            $options[ "prompt" ] = isset($options[ "propmt" ]) ? $options[ "prompt" ] : $prompt;
        if(isset($columns))
        {
            if(!isset($columns["attribute"]))
                $columns["attribute"] = $columns[ "id" ];
            
            if(isset($columns["id"]) && isset($columns["text"]))
                $data = ArrayHelper::map(
                (count($refData) > 0 ) ? $refData : $model[ "ref" ]::find()->all(), 
                    $columns[ "id" ], 
                    $columns[ "text" ]
                );
        }

        

        if(is_object($form))
        {
            return $form->field($model[ "main" ], $columns["attribute"])->dropDownList(
                    $data,
                    $options
            );
        }
        else
        {  
            $options[ "class" ] = ["form-control", "select2"];
            $ref = new $model["ref"];

            return Html::label( $ref->getAttributeLabel(
                        isset($model["label"]) ? $model["label"] : $columns["text"]), 
                        isset($model["name"])  ? $model["name"]  : $columns["attribute"] 
                    ) . 
                    Html::dropDownList ($columns["attribute"], null, 
                            $data,
                            $options
                    );
        }        
    }

}

?>