<?php
require_once(ROOT . "/utils/IController.php");
require_once(ROOT . "/utils/AbstractController.php");
require_once(ROOT . "/utils/functions.php");
require_once(ROOT . "/services/CompteService.php");

class CompteGetController extends AbstractController implements IController{

    private CompteService $service;
    private int $id;

    //construct

    public function __construct($form, $controllerName){
        //Appel du constructeur de la classe mère AbstractController
        parent::__construct($form,$controllerName);
        $this->service = new CompteService();
    }
    //Méthode
    function checkForm(){
        //L'id doit être présent 
        if( ! isset($this->form['id'])){
            error_log("CYBERSEC Receive bad request");
            _400_Bad_Request();
        }
        //Ok

    }

    function checkCybersec(){
        if( ! ctype_digit($this->form['id'])){
            error_log("CYBERSEC Receive bad request");
            _400_Bad_Request();
        }
        $this->id=intval($this->form['id']);
    }
    
//TODO:
    function checkRights(){
        error_log($this->controllerName . "->" . __FUNCTION__);
        // if(!isLogged()){
        //     _401_Unauthorized();
        // }
        //Est ce que j'ai besoin de controller les droits redacteur / Modo/ Admin


    }

//TODO:
    function processRequest(){
        $this->response = $this->service->findById($this->id);

    }
  

}



