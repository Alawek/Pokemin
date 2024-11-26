<?php
require_once(ROOT . "/utils/IController.php");
require_once(ROOT . "/utils/AbstractController.php");
require_once(ROOT . "/utils/functions.php");
require_once(ROOT . "/services/PokeminService.php");
require_once(ROOT . "/utils/session.php");

class PokeminPutController extends AbstractController implements IController
{

    private PokeminService $service;
    private int $idPokemin;
    private ?string $nom;
    private ?string $description;
    private ?string $cri;
    private ?int $idType1;
    private ?int $idType2;
    private ?int $evolution1;
    private ?int $niveauEvolution1;
    private ?int $evolution2;
    private ?int $niveauEvolution2;
    private ?int $tauxApparition;
    private ?int $tauxCapture;
    private ?int $idDon;


    //construct

    public function __construct($form, $controllerName)
    {
        //Appel du constructeur de la classe mère AbstractController
        parent::__construct($form, $controllerName);
        $this->service = new PokeminService();
        $this->nom = null;
        $this->description = null;
        $this->cri = null;
        $this->idType1 = null;
        $this->idType2 = null;
        $this->evolution1 = null;
        $this->niveauEvolution1 = null;
        $this->evolution2 = null;
        $this->niveauEvolution2 = null;
        $this->tauxApparition = null;
        $this->tauxCapture = null;
        $this->idDon = null;
    }
    //Méthode
    function checkForm()
    {
        //nom, description, cri 
        if (! isset($this->form['idPokemin'])) {
            error_log("FORM Information manquante [idPokemin]");
            _400_Bad_Request();
        }
        $this->idPokemin = $this->form['idPokemin'];
    }

    function checkCybersec()
    {

        if (isset($this->form['nom']) && !empty($this->form['nom'])) {
            if ((!preg_match('/^[a-zA-ZÀ-ÿ0-9 .,\'!?-]*$/', $this->form['nom']))) {
                headerCustom(840, "Caracteres non autorises detectes dans le nom.");
            }
            $this->nom = htmlspecialchars(trim($this->form['nom']), ENT_NOQUOTES, 'UTF-8');
        }

        if (isset($this->form['description']) && !empty($this->form['description'])) {
            if (!preg_match('/^[a-zA-ZÀ-ÿ0-9 .,\'!?-]*$/', $this->form['description'])) {
                headerCustom(840, "Caracteres non autorises detectes dans la descripion.");
            }
            $this->description = htmlspecialchars(trim($this->form['description']), ENT_NOQUOTES, 'UTF-8');
        }
        if (isset($this->form['cri']) && !empty($this->form['cri'])) {
            if (!preg_match('/^[a-zA-ZÀ-ÿ0-9 .,\'!?-]*$/', $this->form['cri'])) {
                headerCustom(840, "Caracteres non autorises detectes dans la descripion.");
            }
            $this->cri = htmlspecialchars(trim($this->form['cri']), ENT_NOQUOTES, 'UTF-8');
        }
        if (isset($this->form['idType1']) && !empty($this->form['idType1'])) {
            if (!ctype_digit($this->form['idType1'])) {
                error_log("CYBERSEC Mauvais typage pour l'id type 1");
                _400_Bad_Request();
            }
            $this->idType1 = trim(intval($this->form['idType1']));
        }

        if (isset($this->form['evolution1']) && !empty($this->form['evolution1'])) {
            if (!ctype_digit($this->form['evolution1'])) {
                error_log("CYBERSEC mauvais typage pour id d'evolution1");
                _400_Bad_Request();
            }
            $this->evolution1 = trim($this->form['evolution1']);
        }
        if (isset($this->form['niveauEvolution1']) && !empty($this->form['niveauEvolution1'])) {
            if (!ctype_digit($this->form['niveauEvolution1'])) {
                error_log("CYBERSEC mauvais typage pour le niveau d'evolution");
                _400_Bad_Request();
            }
            $this->niveauEvolution1 = trim($this->form['niveauEvolution1']);
        }
        if (isset($this->form['evolution2']) && !empty($this->form['evolution2'])) {
            if (!ctype_digit($this->form['evolution2'])) {
                error_log("CYBERSEC mauvais typage pour l'id d'evolution2");
                _400_Bad_Request();
            }
            $this->evolution2 = trim($this->form['evolution2']);
        }
        if (isset($this->form['niveauEvolution2']) && !empty($this->form['niveauEvolution2'])) {
            if (!ctype_digit($this->form['niveauEvolution2'])) {
                error_log("CYBERSEC mauvais typage pour le niveau d'evolution2");
                _400_Bad_Request();
            }
            $this->niveauEvolution2 = trim($this->form['niveauEvolution2']);
        }
        if (isset($this->form['tauxApparition']) && !empty($this->form['tauxApparition'])) {
            if (!ctype_digit($this->form['tauxApparition'])) {
                error_log("CYBERSEC mauvais typage pour le taux d'apparition");
                _400_Bad_Request();
            }
            $this->tauxApparition = trim($this->form['tauxApparition']);
        }
        if (isset($this->form['tauxCapture']) && !empty($this->form['tauxCapture'])) {
            if (!ctype_digit($this->form['tauxCapture'])) {
                error_log("CYBERSEC mauvais typage pour le taux de capture");
                _400_Bad_Request();
            }
            $this->tauxCapture = trim($this->form['tauxCapture']);
        }
        if (isset($this->form['idDon']) && !empty($this->form['idDon'])) {
            if (!ctype_digit($this->form['idDon'])) {
                error_log("CYBERSEC mauvais typage pour l'id don'");
                _400_Bad_Request();
            }
            $this->idDon = trim($this->form['idDon']);
        }
        if (isset($this->form['idType2']) && !empty($this->form['idType2'])) {
            if (!ctype_digit($this->form['idType2'])) {
                error_log("CYBERSEC mauvais typage pour le deuxieme id type'");
                _400_Bad_Request();
            }
            $this->idType2 = trim($this->form['idType2']);
        }
    }


    //TODO:
    function checkRights()
    {

        if (!isLogged()) {
            _401_Unauthorized();
        }
    }


    //rajouter le 04/11 à 9:35:23:45:01:45:32:51
    function processRequest()
    {
        $pokemin = $this->service->findById($this->idPokemin);
        if ($this->nom != null) {
            $pokemin->setNom($this->nom);
        }
        if ($this->description != null) {
            $pokemin->setDescription($this->description);
        }
        if ($this->cri != null) {
            $pokemin->setCri($this->cri);
        }
        if ($this->idType1 != null) {
            $pokemin->setIdType1($this->idType1);
        }
        if ($this->idType2 != null) {
            $pokemin->setIdType2($this->idType2);
        }
        if ($this->evolution1 != null) {
            $pokemin->setEvolution1($this->evolution1);
        }
        if ($this->niveauEvolution1 != null) {
            $pokemin->setNiveauEvolution1($this->niveauEvolution1);
        }
        if ($this->evolution2 != null) {
            $pokemin->setEvolution2($this->evolution2);
        }
        if ($this->niveauEvolution2 != null) {
            $pokemin->setNiveauEvolution2($this->niveauEvolution2);
        }
        if ($this->tauxApparition != null) {
            $pokemin->setTauxApparition($this->tauxApparition);
        }
        if ($this->tauxCapture != null) {
            $pokemin->setTauxCapture($this->tauxCapture);
        }
        if ($this->idDon != null) {
            $pokemin->setIdDon($this->tauxIdDon);
        }



      
            $this->response = $this->service->update($pokemin);
             $this->response = "pokemin modifier";
       
    }
}
