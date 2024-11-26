<?php
require_once(ROOT . "/utils/IController.php");
require_once(ROOT . "/utils/AbstractController.php");
require_once(ROOT . "/utils/functions.php");
require_once(ROOT . "/services/PokeminInstanceService.php");
require_once(ROOT . "/utils/session.php");

class PokeminInstancePostController extends AbstractController implements IController
{

    private PokeminInstanceService $service;
    private string $nom;
    private int $niveau;
    private int $experience;
    private int $experienceMax;
    private int $pv;
    private int $pvMax;
    private int $mana;
    private int $manaMax;
    private int $agilite;
    private int $chance;
    private int $endurance;
    private int $esprit;
    private int $puissance;
    private int $intelligence;
    private bool $sauvage;
    private ?bool $actif;
    private int $idPokemin;
    private ?int $idDresseur;
    private ?int $idPersonnage;


    //construct

    public function __construct($form, $controllerName)
    {
        //Appel du constructeur de la classe mère AbstractController
        parent::__construct($form, $controllerName);
        $this->service = new PokeminInstanceService();
        $this->actif = null;
        $this->idDresseur = null;
        $this->idPersonnage = null;
        
    }
    //Méthode
    function checkForm()
    {
        //nom, description, cri 
        if (! isset($this->form['nom'],$this->form['niveau'], $this->form['experience'], $this->form['experienceMax'], $this->form['pv'],$this->form['pvMax'],$this->form['mana'],$this->form['manaMax'],$this->form['agilite'],$this->form['chance'],$this->form['endurance'],$this->form['esprit'],$this->form['puissance'],$this->form['intelligence'],$this->form['sauvage'],$this->form['idPokemin'])) {
            error_log("FORM Information manquante obligatoire.");
            _400_Bad_Request();
        }
       
    }

    function checkCybersec()
    {
        if (! ctype_digit($this->form['niveau'])) {
            error_log("CYBERSEC Mauvais typage pour le niveau");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['experience'])) {
            error_log("CYBERSEC Mauvais typage pour l'experience'");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['experienceMax'])) {
            error_log("CYBERSEC Mauvais typage pour l'experiencemax");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['pv'])) {
            error_log("CYBERSEC Mauvais typage pour les pv");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['pvMax'])) {
            error_log("CYBERSEC Mauvais typage pour les pv max");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['mana'])) {
            error_log("CYBERSEC Mauvais typage pour le mana");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['manaMax'])) {
            error_log("CYBERSEC Mauvais typage pour le manaMax");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['agilite'])) {
            error_log("CYBERSEC Mauvais typage pour l'agilite");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['chance'])) {
            error_log("CYBERSEC Mauvais typage pour la chance");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['endurance'])) {
            error_log("CYBERSEC Mauvais typage pour l'endurance");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['esprit'])) {
            error_log("CYBERSEC Mauvais typage pour l'esprit");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['puissance'])) {
            error_log("CYBERSEC Mauvais typage pour la puissance");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['intelligence'])) {
            error_log("CYBERSEC Mauvais typage pour l'intelligence");
            _400_Bad_Request();
        }
        if (! ctype_digit($this->form['idPokemin'])) {
            error_log("CYBERSEC Mauvais typage pour l'id pokemin");
            _400_Bad_Request();
        }
        
       
        if ((!preg_match('/^[a-zA-ZÀ-ÿ0-9 .,\'!?-]*$/', $this->form['nom']))) {
            headerCustom(840, "Caracteres non autorises detectes.");
        }
    

        $this->nom = htmlspecialchars(trim($this->form['nom']), ENT_NOQUOTES, 'UTF-8');
        $this->niveau = trim(intval($this->form['niveau']));
        $this->experience = trim(intval($this->form['experience']));
        $this->experienceMax = trim(intval($this->form['experienceMax']));
        $this->pv = trim(intval($this->form['pv']));
        $this->pvMax = trim(intval($this->form['pvMax']));
        $this->mana = trim(intval($this->form['mana']));
        $this->manaMax = trim(intval($this->form['manaMax']));
        $this->agilite = trim(intval($this->form['agilite']));
        $this->chance = trim(intval($this->form['chance']));
        $this->endurance = trim(intval($this->form['endurance']));
        $this->esprit = trim(intval($this->form['esprit']));
        $this->puissance = trim(intval($this->form['puissance']));
        $this->intelligence = trim(intval($this->form['intelligence']));
        $this->sauvage = trim(boolval($this->form['sauvage']));
        $this->idPokemin = trim(intval($this->form['idPokemin']));






        if (isset($this->form['actif'])&& !empty($this->form['actif'])) {
          
            $this->actif = trim(boolval($this->form['actif']));
        }
        if (isset($this->form['idDresseur'])&& !empty($this->form['idDresseur'])) {
            if (!ctype_digit($this->form['idDresseur'])) {
                error_log("CYBERSEC mauvais typage pour l'id dresseur'");
                _400_Bad_Request();
            }
            $this->idDresseur = trim(boolval($this->form['idDresseur']));
        }
        if (isset($this->form['idPersonnage'])&& !empty($this->form['idPersonnage'])) {
            if (!ctype_digit($this->form['idPersonnage'])) {
                error_log("CYBERSEC mauvais typage pour l'id du Personnage");
                _400_Bad_Request();
            }
            $this->idPersonnage = trim(boolval($this->form['idPersonnage']));
        }
        
    }


    //TODO:
    function checkRights()
    {
        
        if (!isLogged() || getRoleIdFromSession()<2) {
            _401_Unauthorized();
        }
        
    }


    //rajouter le 04/11 à 9:35:23:45:01:45:32:51
    function processRequest()
    {
        $pokeminInstance = $this->service->getDao()->create($this->nom, $this->niveau, $this->experience,$this->experienceMax,$this->pv,$this->pvMax,$this->mana,$this->manaMax,$this->agilite,$this->chance,$this->endurance,$this->esprit,$this->puissance,$this->intelligence,$this->sauvage,$this->actif,$this->idPokemin,$this->idDresseur,$this->idPersonnage);
        try {
            $this->response = $this->service->insert($pokeminInstance);
        } catch (ConstraintUniqueException $ex) {
            // var_dump($ex);
            headerCustom(498, "Business Error " . $ex->getCode() . " " . $ex->getMessage());
        } catch (Exception $ex) {
            var_dump($ex);
        }
        // ???? sur les cas de tests ???
    }
}
