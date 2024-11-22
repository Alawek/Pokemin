<?php
require_once(ROOT . "/utils/IController.php");
require_once(ROOT . "/utils/AbstractController.php");
require_once(ROOT . "/utils/functions.php");
require_once(ROOT . "/services/PokeminService.php");
require_once(ROOT . "/utils/session.php");

class PokeminPostController extends AbstractController implements IController
{

    private PokeminService $service;
    private string $nom;
    private string $description;
    private string $cri;
    private int $idType1;
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
        $this->service = new CompteService();
    }
    //Méthode
    function checkForm()
    {
        //nom, description, cri 
        if (! isset($this->form['nom'], $this->form['description'], $this->form['cri'], $this->form['idType1'])) {
            error_log("FORM Information manquante [nom||description||cri||idType1]");
            _400_Bad_Request();
        }
        trim($this->form['nom']);
        trim($this->form['description']);
        trim($this->form['cri']);
        trim($this->form['idType1']);
    }

    function checkCybersec()
    {
        if (!ctype_digit($this->form['idType1'])) {
            error_log("CYBERSEC Mauvais typage pour l'id type 1");
            _400_Bad_Request();
        }
        if ((!preg_match('/^[a-zA-ZÀ-ÿ0-9 .,!?-]*$/', $this->form['description'])) ||
            (!preg_match('/^[a-zA-ZÀ-ÿ0-9 .,!?-]*$/', $this->form['nom'])) ||
            (!preg_match('/^[a-zA-ZÀ-ÿ0-9 .,!?-]*$/', $this->form['cri']))
        ) {
            headerCustom(840, "Caractères non autorisés détectés.");
        }
        $this->description = htmlspecialchars($this->form['description'], ENT_QUOTES, 'UTF-8');
        if (isset($this->form['evolution1'])) {
            if (!ctype_digit($this->form['evolution1'])) {
                error_log("CYBERSEC mauvais typage pour id l'evolution1");
                _400_Bad_Request();
            }
            $this->evolution1 = htmlspecialchars($this->form['evolution1'], ENT_QUOTES, 'UTF-8');

        }
        if(isset($this->form['niveauevolution1'])){
            if(!ctype_digit($this->form['niveauevolution1'])){
                error_log("CYBERSEC mauvais typage pour le niveau d'évolution");
                _400_Bad_Request();
            }
            $this->niveauEvolution1 = htmlspecialchars($this->form['niveauevolution1'], ENT_QUOTES, 'UTF-8');

        }
    }

    //TODO:
    function checkRights()
    {
        error_log($this->controllerName . "->" . __FUNCTION__ .
            "Vous etes deja connecté");
        if (isLogged()) {
            headerCustom(499, "Already Authenficated");
        }
    }


    //rajouter le 04/11 à 9:35:23:45:01:45:32:51
    function processRequest()
    {
        $compte = $this->service->getDao()->create($this->nom, $this->description, $this->password);
        try {
            $this->response = $this->service->insert($compte);
        } catch (ConstraintUniqueException $ex) {
            // var_dump($ex);
            headerCustom(498, "Business Error " . $ex->getCode() . " " . $ex->getMessage());
        } catch (Exception $ex) {
            var_dump($ex);
        }
        // ???? sur les cas de tests ???
    }
}
