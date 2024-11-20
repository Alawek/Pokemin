<?php

abstract class AnimalAbstract{
    //Attributs de la class abstraite
    public $id;
    public $name;
    public $color;
    public $type;
    public $faim = false;
    public $cri;
    public int $fatigue;
    public int $fatigueMax;
    public $attaque1;
    public $degat1;
    public $attaque2;
    public $degat2;
    public $attaque3;
    public $degat3;

    //Méthodes de la class

    function manger(){
        $this->faim = false;
        return($this->name . " a manger");
    }

    function aFaim(){
        if($this->faim){
            return $this->name . ' a faim';
        }
        return $this->name . ' n\'a pas faim';
    }

    function estFatiguer(){
        if($this->fatigue==0){
            return($this->name . ' est K.O !');
        }
        return($this-> name . ' est en vie !');
    }

    function dormir(){
        $this->fatigue=$this->fatigueMax;
        return($this->name . ' a recuperer de ca fatigue ' . $this->fatigue);
    }

    function subir(int $degat){
        $this->fatigue=$this->fatigue-$degat;
        return $this->name . ' a subis des degats d\'une valeur de ' . $degat . " il lui reste " . $this->fatigue . "/" . $this->fatigueMax;
    }

    function attaqueUn(){
        
        return $this->name . ' utilise ' . $this->attaque1 . ' est inflige ' . $this->degat1 . " de degats.";

    }

    function attaqueDeux(){
        
        return $this->name . ' utilise ' . $this->attaque2 . ' est inflige ' . $this->degat2 . " de degats.";

    }

    function attaqueTrois(){
        $this->fatigue+=$this->degat3;
        
        return $this->name . ' utilise ' . $this->attaque3 . ' est ce soigne de ' . $this->degat3 . " de pv. vous avez " . $this->fatigue . "/" . $this->fatigueMax ;
    }

    // function attaqueUn($degat){
    //     $degat=$this->degat1;
    //     return $this->name . ' utilise ' . $this->attaque1 . ' est inflige ' . $degat . " de dégats.";

    // }

    // function attaqueDeux($degat){
    //     $degat=$this->degat2;
    //     return $this->name . ' utilise ' . $this->attaque2 . ' est inflige ' . $degat . " de dégats.";
    // }

}