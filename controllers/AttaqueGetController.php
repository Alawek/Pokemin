<?php
require_once(ROOT . "/utils/IController.php");
require_once(ROOT . "/utils/AbstractController.php");
require_once(ROOT . "/utils/functions.php");
require_once(ROOT . "/Animal/LeoClass.php");
require_once(ROOT . "/Animal/FelixClass.php");
require_once(ROOT . "/Animal/SquirteuseClass.php");


class AttaqueGetController extends AbstractController implements IController{

    public Leo $leo;
    public Felix $felix;
    public Squirteuse $squirteuse;
    public $attaque;
    public $pokemin;
    public $pokeminDefenseur;

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
        if( ! isset($this->form['pokemin'],$this->form['attaque'],$this->form['pokeminDefenseur'])){
            
        
        }
        $this->attaque=$this->form['attaque'];
        $this->pokemin=$this->form['pokemin'];
        $this->pokeminDefenseur=$this->form['pokeminDefenseur'];
    }


    function checkCybersec(){
        
       
        
    }

    function checkRights(){
        error_log($this->controllerName . "->" . __FUNCTION__);

    }

    function processRequest(){
        
        if($this->form['pokemin']==1 && $this->form['pokeminDefenseur']==2){
            $this->pokemin=$this->leo;
            $this->pokeminDefenseur=$this->felix;
            if($this->attaque==1){
                $this->response= $this->pokemin->attaqueUn() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat1);
                
            }
            if($this->attaque==2){
                $this->response= $this->pokemin->attaqueDeux() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat2);
            }
            if($this->attaque==3){
                $this->response=$this->pokemin->attaqueTrois();
            }
        }
        if($this->form['pokemin']==1 && $this->form['pokeminDefenseur']==3){
            $this->pokemin=$this->leo;
            $this->pokeminDefenseur=$this->squirteuse;
            if($this->attaque==1){
                $this->response= $this->pokemin->attaqueUn() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat1);
                
            }
            if($this->attaque==2){
                $this->response= $this->pokemin->attaqueDeux() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat2);
            }
            if($this->attaque==3){
                $this->response=$this->pokemin->attaqueTrois();
            }
        }
        if($this->form['pokemin']==2 && $this->form['pokeminDefenseur']==1){
            $this->pokemin=$this->felix;
            $this->pokeminDefenseur=$this->leo;
            if($this->attaque==1){
                $this->response= $this->pokemin->attaqueUn() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat1);
                
            }
            if($this->attaque==2){
                $this->response= $this->pokemin->attaqueDeux() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat2);
            }
            if($this->attaque==3){
                $this->response=$this->pokemin->attaqueTrois();
            }
        }
        if($this->form['pokemin']==2 && $this->form['pokeminDefenseur']==3){
            $this->pokemin=$this->felix;
            $this->pokeminDefenseur=$this->squirteuse;
            if($this->attaque==1){
                $this->response= $this->pokemin->attaqueUn() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat1);
                
            }
            if($this->attaque==2){
                $this->response= $this->pokemin->attaqueDeux() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat2);
            }
            if($this->attaque==3){
                $this->response=$this->pokemin->attaqueTrois();
            }
        }
        if($this->form['pokemin']==3 && $this->form['pokeminDefenseur']==1){
            $this->pokemin=$this->squirteuse;
            $this->pokeminDefenseur=$this->leo;
            if($this->attaque==1){
                $this->response= $this->pokemin->attaqueUn() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat1);
                
            }
            if($this->attaque==2){
                $this->response= $this->pokemin->attaqueDeux() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat2);
            }
            if($this->attaque==3){
                $this->response=$this->pokemin->attaqueTrois();
            }
        }
        if($this->form['pokemin']==3 && $this->form['pokeminDefenseur']==2){
            $this->pokemin=$this->squirteuse;
            $this->pokeminDefenseur=$this->felix;
            if($this->attaque==1){
                $this->response= $this->pokemin->attaqueUn() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat1);
                
            }
            if($this->attaque==2){
                $this->response= $this->pokemin->attaqueDeux() . "<br>" . $this->pokeminDefenseur->subir($this->pokemin->degat2);
            }
            if($this->attaque==3){
                $this->response=$this->pokemin->attaqueTrois();
            }
        }
    }

       
           

    }

    

    




?>