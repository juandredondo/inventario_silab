<?php 
namespace app\components\core;

/**
 * Interfaz para que un objecto tenga una propiedad que indique si es consumible o no
 * Esto, permite que cualquier clase que implemente esta interfaz, debe proveer un getter o setter
 * sobre la propiedad que representara el "check-in" si es consumible
 * @author Jeancarlo Fontalvo
 */
interface ConsumibleInterface {
    public function getIsConsumible();
    public function setIsConsumible($value);
}
?>