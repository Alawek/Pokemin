<?php
require_once(ROOT . "/utils/IController.php");
require_once(ROOT . "/utils/AbstractController.php");
require_once(ROOT . "/utils/functions.php");
require_once(ROOT . "/Animal/LeoClass.php");
require_once(ROOT . "/Animal/FelixClass.php");
require_once(ROOT . "/Animal/SquirteuseClass.php");


class AnimalGetController extends AbstractController implements IController{

    public Leo $leo;
    public Felix $felix;
    public Squirteuse $squirteuse;
    public $pokemin;

    //construct

    public function __construct($form, $controllerName){
        //Appel du constructeur de la classe mère AbstractController
        parent::__construct($form,$controllerName);
        $this->leo = new Leo();
        $this->squirteuse = new Squirteuse();
        $this->felix= new Felix();
    }
    //Méthode
    function checkForm(){
        if( ! isset($this->form['pokemin'])){
            
        
        }
        
        $this->pokemin=$this->form['pokemin'];
    }


    function checkCybersec(){
        
       
        
    }

    function checkRights(){
        error_log($this->controllerName . "->" . __FUNCTION__);

    }

    function processRequest(){
        
        if($this->form['pokemin']==1){
            $this->pokemin=$this->leo;
            $this->response=["Id" => $this->pokemin->id,
                "Nom" => $this->pokemin->name,
                "Couleur" =>  $this->pokemin->color,
                "Cri" => $this->pokemin->cri,
                "Type" => $this->pokemin->type,
                "PV" => $this->pokemin->fatigue,
                "PVmax" => $this->pokemin->fatigueMax,
                "Attaque1" => $this->pokemin->attaque1,
                "degat"  =>$this->pokemin->degat1,
                "Attaque2" => $this->pokemin->attaque2,
                "degat2" => $this->pokemin->degat2,
                "Attaque3" => $this->pokemin->attaque3,
                "soin" => $this->pokemin->degat3];


        }
        if($this->form['pokemin']==2){
            $this->pokemin=$this->felix;
            $this->response=["Id" => $this->pokemin->id,
                "Nom" => $this->pokemin->name,
                "Couleur" =>  $this->pokemin->color,
                "Cri" => $this->pokemin->cri,
                "Type" => $this->pokemin->type,
                "PV" => $this->pokemin->fatigue,
                "PVmax" => $this->pokemin->fatigueMax,
                "Attaque1" => $this->pokemin->attaque1,
                "degat"  =>$this->pokemin->degat1,
                "Attaque2" => $this->pokemin->attaque2,
                "degat2" => $this->pokemin->degat2,
                "Attaque3" => $this->pokemin->attaque3,
                "soin" => $this->pokemin->degat3];
        }
        if($this->form['pokemin']==3){
            $this->pokemin=$this->squirteuse;
            $this->response=["Id" => $this->pokemin->id,
                "Nom" => $this->pokemin->name,
                "Couleur" =>  $this->pokemin->color,
                "Cri" => $this->pokemin->cri,
                "Type" => $this->pokemin->type,
                "PV" => $this->pokemin->fatigue,
                "PVmax" => $this->pokemin->fatigueMax,
                "Attaque1" => $this->pokemin->attaque1,
                "degat"  =>$this->pokemin->degat1,
                "Attaque2" => $this->pokemin->attaque2,
                "degat2" => $this->pokemin->degat2,
                "Attaque3" => $this->pokemin->attaque3,
                "soin" => $this->pokemin->degat3];
        }
    }

       
           

    }