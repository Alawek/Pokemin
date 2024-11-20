<?php
require_once(ROOT . "/utils/IController.php");
require_once(ROOT . "/utils/AbstractController.php");
require_once(ROOT . "/utils/functions.php");
require_once(ROOT . "/Animal/LeoClass.php");
require_once(ROOT . "/Animal/FelixClass.php");
require_once(ROOT . "/Animal/SquirteuseClass.php");


class DormirGetController extends AbstractController implements IController{

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
            $this->response=$this->pokemin->dormir();
        }
        if($this->form['pokemin']==2){
            $this->pokemin=$this->felix;
            $this->response=$this->pokemin->dormir();
        }
        if($this->form['pokemin']==3){
            $this->pokemin=$this->squirteuse;
            $this->response=$this->pokemin->dormir();
        }
    }

       
           

    }

    

    




?>