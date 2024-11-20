<?php
require_once(ROOT . "/utils/IController.php");
require_once(ROOT . "/utils/functions.php");

abstract class AbstractController implements IController{

    protected $form;
    protected $controllerName;
    protected $response;
    //constructeur, permet de faire un "new" une nouvelle instance de la classe
    public function __construct($form, $controllerName){
        $this->form = $form;
        $this->controllerName = $controllerName;
    }

    function execute(){
        $this->checkForm(); // vérifier les odnnées de formulaire
        $this->checkCybersec(); //Vérifier la cybersecurité
        $this->checkRights(); // Controller les droit d'accées
        $this->processRequest(); // Traiter la requête 
        $this->processResponse(); // fournir la reponse
    }

    function processResponse(){
        if(is_null($this->response)){
            _404_Not_Found();
        }
        echo json_encode($this->response);
    }


    abstract function checkForm();
    abstract function checkCybersec();
    abstract function checkRights();
    abstract function processRequest();
    


}

