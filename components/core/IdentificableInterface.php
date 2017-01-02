<?php 

namespace app\components\core;

/**
 * Interfaz para que un objecto tenga una propiedad que defina su id
 * Esto, permite que cualquier clase que implemente esta interfaz, debe proveer un getter o setter
 * sobre la propiedad que representara el id
 * @author Jeancarlo Fontalvo
 */
interface IdentificableInterface
{
    public function getId();
    public function setId($value);
}


?>