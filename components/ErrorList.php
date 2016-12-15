<?php 
namespace app\components;

class ErrorList 
{
    public static function render($errors)
    {
        if(isset($errors) && count($errors) > 0)
        {
            echo "<ul>";
            foreach($errors as $property => $error)
            {
                echo "<li>" . $person->getAttributeLabel($property) . "</><ul>";
                for($i = 0; $i < count($error); $i++)
                {
                    echo "<li>" . $error[ $i ] ."</li>";
                }
                echo "</ul></li>";
            }
            echo "</ul>";
        }
        
    }
}

?>