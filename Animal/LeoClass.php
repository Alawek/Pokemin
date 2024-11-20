<?php
require_once(ROOT . '/Animal/AnimalAbstract.php');
require_once(ROOT . '/Animal/AnimalInterface.php');

class Leo extends AnimalAbstract implements AnimalInterface
{
    //Attribut



    //Construct
    function __construct()
    {
        $this->id = 2;
        $this->name = "Leo la bonne patchole";
        $this->color = "Marron";
        $this->type = "Sauvage/Poilu";
        $this->cri = "Roooooaaaar'han";
        $this->faim = true;
        $this->fatigueMax = 150;
        $this->fatigue = 150;
        $this->attaque1 = "Griffe sale";
        $this->degat1 = 30;
        $this->attaque2 = "Coup de queue de sauvage";
        $this->degat2 = 50;
        $this->attaque3 = "Pater pour chat";
        $this->degat3 = 20;
    }

    //Méthode
    function crier(): string
    {
        return $this->cri;
    }
}
