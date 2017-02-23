<?php 
namespace app\components\core;

/**
 * Interfaz para que un objecto tenga una propiedad que defina su fecha de expiracion
 * Esto, permite que cualquier clase que implemente esta interfaz, debe proveer un getter o setter
 * sobre la propiedad que representara la fecha de expiracion
 * @author Jeancarlo Fontalvo
 */
interface ExpirableInterface
{
    public function getExpirationDate();
    public function setExpirationDate($value);
}

?>