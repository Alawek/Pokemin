<?php
require_once(ROOT . "/utils/IController.php");
require_once(ROOT . "/utils/AbstractController.php");
require_once(ROOT . "/utils/functions.php");
require_once(ROOT . "/services/PokeminInstanceService.php");
require_once(ROOT . "/utils/session.php");

class PokeminInstancePutController extends AbstractController implements IController
{

    private PokeminInstanceService $service;
    private int $idInstance;
    private ?string $nom;
    private ?int $niveau;
    private ?int $experience;
    private ?int $experienceMax;
    private ?int $pv;
    private ?int $pvMax;
    private ?int $mana;
    private ?int $manaMax;
    private ?int $agilite;
    private ?int $chance;
    private ?int $endurance;
    private ?int $esprit;
    private ?int $puissance;
    private ?int $intelligence;
    private ?bool $sauvage;
    private ?bool $actif;
    private ?int $idPokemin;
    private ?int $idDresseur;
    private ?int $idPersonnage;



    //construct

    public function __construct($form, $controllerName)
    {
        //Appel du constructeur de la classe mère AbstractController
        parent::__construct($form, $controllerName);
        $this->service = new PokeminService();
        $this->nom = null;
        $this->niveau = null;
        $this->experience = null;
        $this->experienceMax = null;
        $this->pv = null;
        $this->pvMax = null;
        $this->mana = null;
        $this->manaMax = null;
        $this->agilite = null;
        $this->chance = null;
        $this->endurance = null;
        $this->esprit = null;
        $this->puissance = null;
        $this->intelligence = null;
        $this->sauvage = null;
        $this->actif = null;
        $this->idPokemin = null;
        $this->idDresseur = null;
        $this->idPersonnage = null;
    }
    //Méthode
    function checkForm()
    {
        //nom, niveau, experience 
        if (! isset($this->form['idInstance'])) {
            error_log("FORM Information manquante [idInstance]");
            _400_Bad_Request();
        }
        $this->idInstance = $this->form['idInstance'];
    }

    function checkCybersec()
    {

        if (isset($this->form['nom']) && !empty($this->form['nom'])) {
            if ((!preg_match('/^[a-zA-ZÀ-ÿ0-9 .,\'!?-]*$/', $this->form['nom']))) {
                headerCustom(840, "Caracteres non autorises detectes dans le nom.");
            }
            $this->nom = htmlspecialchars(trim($this->form['nom']), ENT_NOQUOTES, 'UTF-8');
        }

        if (isset($this->form['niveau']) && !empty($this->form['niveau'])) {
            if (!ctype_digit($this->form['niveau'])) {
                _400_Bad_Request();
            }
            $this->niveau = trim(intval($this->form['niveau']));
        }
        if (isset($this->form['experience']) && !empty($this->form['experience'])) {
            if (!ctype_digit($this->form['experience'])) {
                _400_Bad_Request();
            }
            $this->experience =trim(intval($this->form['experience']));
        }
        if (isset($this->form['experienceMax']) && !empty($this->form['experienceMax'])) {
            if (!ctype_digit($this->form['experienceMax'])) {
                error_log("CYBERSEC Mauvais typage pour l'id type 1");
                _400_Bad_Request();
            }
            $this->experienceMax = trim(intval($this->form['experienceMax']));
        }
        if (isset($this->form['pv']) && !empty($this->form['pv'])) {
            if (!ctype_digit($this->form['pv'])) {
                error_log("CYBERSEC mauvais typage pour le deuxieme id type'");
                _400_Bad_Request();
            }
            $this->pv = trim($this->form['pv']);
        }

        if (isset($this->form['pvMax']) && !empty($this->form['pvMax'])) {
            if (!ctype_digit($this->form['pvMax'])) {
                error_log("CYBERSEC mauvais typage pour id d'pvMax");
                _400_Bad_Request();
            }
            $this->pvMax = trim($this->form['pvMax']);
        }
        if (isset($this->form['mana']) && !empty($this->form['mana'])) {
            if (!ctype_digit($this->form['mana'])) {
                error_log("CYBERSEC mauvais typage pour le niveau d'evolution");
                _400_Bad_Request();
            }
            $this->mana = trim($this->form['mana']);
        }
        if (isset($this->form['manaMax']) && !empty($this->form['manaMax'])) {
            if (!ctype_digit($this->form['manaMax'])) {
                error_log("CYBERSEC mauvais typage pour l'id d'manaMax");
                _400_Bad_Request();
            }
            $this->manaMax = trim($this->form['manaMax']);
        }
        if (isset($this->form['agilite']) && !empty($this->form['agilite'])) {
            if (!ctype_digit($this->form['agilite'])) {
                error_log("CYBERSEC mauvais typage pour le niveau d'manaMax");
                _400_Bad_Request();
            }
            $this->agilite = trim($this->form['agilite']);
        }
        if (isset($this->form['chance']) && !empty($this->form['chance'])) {
            if (!ctype_digit($this->form['chance'])) {
                error_log("CYBERSEC mauvais typage pour le taux d'apparition");
                _400_Bad_Request();
            }
            $this->chance = trim($this->form['chance']);
        }
        if (isset($this->form['endurance']) && !empty($this->form['endurance'])) {
            if (!ctype_digit($this->form['endurance'])) {
                error_log("CYBERSEC mauvais typage pour le taux de capture");
                _400_Bad_Request();
            }
            $this->endurance = trim($this->form['endurance']);
        }
        if (isset($this->form['esprit']) && !empty($this->form['esprit'])) {
            if (!ctype_digit($this->form['esprit'])) {
                error_log("CYBERSEC mauvais typage pour l'id don'");
                _400_Bad_Request();
            }
            $this->esprit = trim($this->form['esprit']);
        }
        
        if (isset($this->form['puissance']) && !empty($this->form['puissance'])) {
            if (!ctype_digit($this->form['puissance'])) {
                error_log("CYBERSEC mauvais typage puissance");
                _400_Bad_Request();
            }
            $this->puissance = trim($this->form['puissance']);
        }
        if (isset($this->form['intelligence']) && !empty($this->form['intelligence'])) {
            if (!ctype_digit($this->form['intelligence'])) {
                error_log("CYBERSEC mauvais typage intelligence");
                _400_Bad_Request();
            }
            $this->intelligence = trim($this->form['intelligence']);
        }
        if (isset($this->form['sauvage']) && !empty($this->form['sauvage'])) {
            
            $this->sauvage = trim($this->form['sauvage']);
        }
        if (isset($this->form['actif']) && !empty($this->form['actif'])) {
            
            $this->actif = trim($this->form['actif']);
        }
        if (isset($this->form['idPokemin']) && !empty($this->form['idPokemin'])) {
            if (!ctype_digit($this->form['idPokemin'])) {
                error_log("CYBERSEC mauvais typage idPokemin");
                _400_Bad_Request();
            }
            $this->idPokemin = trim($this->form['idPokemin']);
        }
        if (isset($this->form['idDresseur']) && !empty($this->form['idDresseur'])) {
            if (!ctype_digit($this->form['idDresseur'])) {
                error_log("CYBERSEC mauvais typage idDresseur");
                _400_Bad_Request();
            }
            $this->idDresseur = trim($this->form['idDresseur']);
        }
        if (isset($this->form['idPersonnage']) && !empty($this->form['idPersonnage'])) {
            if (!ctype_digit($this->form['idPersonnage'])) {
                error_log("CYBERSEC mauvais typage idPersonnage");
                _400_Bad_Request();
            }
            $this->idPersonnage = trim($this->form['idPersonnage']);
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
        $pokeminInstance = $this->service->findById($this->idInstance);
        if ($this->nom != null) {
           $pokeminInstance->setNom($this->nom);
        }
        if ($this->niveau != null) {
           $pokeminInstance->setNiveau($this->niveau);
        }
        if ($this->experience != null) {
           $pokeminInstance->setExperience($this->experience);
        }
        if ($this->experienceMax != null) {
           $pokeminInstance->setExperienceMax($this->experienceMax);
        }
        if ($this->pv != null) {
           $pokeminInstance->setPv($this->pv);
        }
        if ($this->pvMax != null) {
           $pokeminInstance->setPvMax($this->pvMax);
        }
        if ($this->mana != null) {
           $pokeminInstance->setMana($this->mana);
        }
        if ($this->manaMax != null) {
           $pokeminInstance->setManaMax($this->manaMax);
        }
        if ($this->agilite != null) {
           $pokeminInstance->setAgilite($this->agilite);
        }
        if ($this->chance != null) {
           $pokeminInstance->setChance($this->chance);
        }
        if ($this->endurance != null) {
           $pokeminInstance->setEndurance($this->endurance);
        }
        if ($this->esprit != null) {
           $pokeminInstance->setEsprit($this->esprit);
        }




        $this->response = $this->service->update($pokeminInstance);
        $this->response = "pokemin modifier";
    }
}
