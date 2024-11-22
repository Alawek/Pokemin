<?php

require_once(ROOT . "/utils/IEntity.php");

abstract class AbstractEntity implements IEntity
{
    /*permet de prendre les champs privés d'un instance de classe
         et de la rendre disponible pour la serialisation*/
    public function jsonSerialize(): array
    {
        // return get_object_vars($this);
        //Permet d'explorer la classe avec le mécanisme de Réflexivité /Introspection
        $reflection = new ReflectionClass($this);
        $properties = array();
        //Pour chaque champs de ma classe
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true); // Il est privé , je le rend public
            //J'extrais la valeur que je stocje dans un tableau associatif
            $properties[$property->getName()] = $property->getValue($this);
            $property->setAccessible(false); // Je remets le champs privé
        }
        return $properties;
    }
}
