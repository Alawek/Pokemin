<?php
//______REQUIRE_______________________________________________________________________________________________________________________________________________________________

require_once(ROOT . "/utils/IEntity.php");
require_once(ROOT . "/utils/AbstractEntity.php");
//______REQUIRE_______________________________________________________________________________________________________________________________________________________________

class PokeminInstance extends AbstractEntity implements IEntity
{
    //______ATTRIBUT_______________________________________________________________________________________________________________________________________________________________
    private int $idInstance;
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
    private ?Pokemin $pokeminBase;
    private ?int $idDresseur;
    private ?int $idPersonnage;
    //______ATTRIBUT_______________________________________________________________________________________________________________________________________________________________

    //______CONSTRUCTEUR_______________________________________________________________________________________________________________________________________________________________

    function __construct()
    { /* RAS */
    }
    //______CONSTRUCTEUR_______________________________________________________________________________________________________________________________________________________________

    //______GETTER/SETTER_______________________________________________________________________________________________________________________________________________________________

    public function getIdInstance(): int
    {
        return $this->idInstance;
    }

    public function setIdInstance(int $idInstance)
    {
        $this->idInstance = $idInstance;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function getNiveau(): int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau)
    {
        $this->niveau = $niveau;
    }

    public function getExperience(): int
    {
        return $this->experience;
    }

    public function setExperience(int $experience)
    {
        $this->experience = $experience;
    }

    public function getExperienceMax(): int
    {
        return $this->experienceMax;
    }

    public function setExperienceMax(int $experienceMax)
    {
        $this->experienceMax = $experienceMax;
    }

    public function getPv(): int
    {
        return $this->pv;
    }

    public function setPv(int $pv)
    {
        $this->pv = $pv;
    }

    public function getPvMax(): int
    {
        return $this->pvMax;
    }

    public function setPvMax(int $pvMax)
    {
        $this->pvMax = $pvMax;
    }

    public function getMana(): int
    {
        return $this->mana;
    }

    public function setMana(int $mana)
    {
        $this->mana = $mana;
    }

    public function getManaMax(): int
    {
        return $this->manaMax;
    }

    public function setManaMax(int $manaMax)
    {
        $this->manaMax = $manaMax;
    }

    public function getAgilite(): int
    {
        return $this->agilite;
    }

    public function setAgilite(int $agilite)
    {
        $this->agilite = $agilite;
    }

    public function getChance(): int
    {
        return $this->chance;
    }

    public function setChance(int $chance)
    {
        $this->chance = $chance;
    }

    public function getEndurance(): int
    {
        return $this->endurance;
    }

    public function setEndurance(int $endurance)
    {
        $this->endurance = $endurance;
    }

    public function getEsprit(): int
    {
        return $this->esprit;
    }

    public function setEsprit(int $esprit)
    {
        $this->esprit = $esprit;
    }

    public function getPuissance(): int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance)
    {
        $this->puissance = $puissance;
    }

    public function getIntelligence(): int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence)
    {
        $this->intelligence = $intelligence;
    }

    public function estSauvage(): bool
    {
        return $this->sauvage;
    }

    public function setSauvage(bool $sauvage)
    {
        $this->sauvage = $sauvage;
    }

    public function estActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif)
    {
        $this->actif = $actif;
    }

    public function getIdPokemin(): int
    {
        return $this->idPokemin;
    }

    public function setIdPokemin(int $idPokemin)
    {
        $this->idPokemin = $idPokemin;
    }

    public function getIdDresseur(): ?int
    {
        return $this->idDresseur;
    }

    public function setIdDresseur(?int $idDresseur)
    {
        $this->idDresseur = $idDresseur;
    }

    public function getIdPersonnage(): ?int
    {
        return $this->idPersonnage;
    }

    public function setIdPersonnage(?int $idPersonnage)
    {
        $this->idPersonnage = $idPersonnage;
    }

    function getPokeminBase() : ?Pokemin {
        return $this->pokeminBase;
    }

    function setPokeminBase(Pokemin $Pokemin) {
        $this->pokeminBase = $Pokemin;
    }

    //______GETTER/SETTER_______________________________________________________________________________________________________________________________________________________________
    //______METHODE_______________________________________________________________________________________________________________________________________________________________
    //______METHODE_______________________________________________________________________________________________________________________________________________________________
    //______METHODE STATIC_______________________________________________________________________________________________________________________________________________________________	
    // //______METHODE STATIC_______________________________________________________________________________________________________________________________________________________________




}
