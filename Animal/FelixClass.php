<?php
require_once(ROOT . '/Animal/AnimalAbstract.php');
require_once (ROOT . '/Animal/AnimalInterface.php');

class Felix extends AnimalAbstract implements AnimalInterface{
    //Attribut
    


    //Construct
    function __construct(){
        $this->id=1;
        $this->name="Felix le chatteu";
        $this->color="Noir mais pas trop, avec une predominance de blanc";
        $this->type="Fragile/Tres beau";
        $this->cri="AAAAAAAAaaaaaeeeen'Hen";
        $this->faim=true;
        $this->fatigueMax=200;
        $this->fatigue=200;
        $this->attaque1="caca d'oiseau";
        $this->degat1=20;
        $this->attaque2="Pleurnichement";
        $this->degat2=50;
        $this->attaque3="Renflouage de caisse";
        $this->degat3=30;
        
    }

    //Méthode
    function crier(): string{
        return $this->cri;
    }


    
}