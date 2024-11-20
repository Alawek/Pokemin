<?php
require_once(ROOT . '/Animal/AnimalAbstract.php');
require_once (ROOT . '/Animal/AnimalInterface.php');


class Squirteuse extends AnimalAbstract implements AnimalInterface{
    //Attribut
    


    //Construct
    function __construct(){
        $this->id=3;
        $this->name="Squirteuse la floteuse";
        $this->color="Aqua Marine/ jaunasse";
        $this->type="Jouisseuse/Mouilleuse";
        $this->cri="Han Han Han Han";
        $this->faim=true;
        $this->fatigueMax=150;
        $this->fatigue=150;
        $this->attaque1="Branlette";
        $this->degat1=20;
        $this->attaque2="Bouche en cul";
        $this->degat2=50;
        $this->attaque3="flot reparateur";
        $this->degat3=30;
    }

    //Méthode
    function crier(): string{
        return $this->cri;
    }

   
}