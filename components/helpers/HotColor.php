<?php 
namespace app\components\helpers;

/**
* Genera colores desde la gama de rojo a la gama verde
* Usado para generar intervalos de colores para indicar estados de alerta a suficiente, etc
* La clase es un port a php de un script: [http://stackoverflow.com/a/4161398/3786841]
* @author Jeancarlo Fontalvo
*/
class HotColor 
{
    public static function generate($size = 10, $asociateWith = []) {
        $red        = 255; //i.e. FF
        $green      = 0;
        $stepSize   = (round( 255 / $size) * 2);
        $colors     = [];
        $count      = !empty($asociateWith) ? count( $asociateWith ) : $size;
        $counter    = 0;

        while($green < 255 && $counter < $count)
        {
            $green += $stepSize;
            if($green > 255) { $green = 255; }

            $colors[ !empty($asociateWith) ? $asociateWith[ $counter ] : $counter ] = self::toRgbCode($red, $green);
            $counter++;
        }

        while($red > 0 && $counter < $count )
        {
            $red -= $stepSize;
            if($red < 0) { $red = 0; }            
            $colors[ !empty($asociateWith) ? $asociateWith[ $counter ] : $counter ] = self::toRgbCode($red, $green);
            $counter++;
        }
        
        return $colors;
    }

    private static function toRgbCode($red, $green, $blue = 100, $alpha = 1)
    {
        return "rgba($red, $green, $blue, $alpha)";
    }
}
?>