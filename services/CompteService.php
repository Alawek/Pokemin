<?php
//______REQUIRE_______________________________________________________________________________________________________________________________________________________________
require_once(ROOT . "/utils/IService.php");
require_once(ROOT . "/utils/AbstractService.php");
require_once(ROOT . "/utils/IDao.php");
require_once(ROOT . "/dao/CompteDao.php");
require_once(ROOT . "/model/Compte.php");
//______REQUIRE_______________________________________________________________________________________________________________________________________________________________



class CompteService extends AbstractService implements IService
{
    //______ATTRIBUT_______________________________________________________________________________________________________________________________________________________________

    private CompteDao $dao;

    //______ATTRIBUT_______________________________________________________________________________________________________________________________________________________________
    //______CONSTRUCTEUR_______________________________________________________________________________________________________________________________________________________________

    function __construct()
    {
        $this->dao = new CompteDao();
    }
    //______CONSTRUCTEUR_______________________________________________________________________________________________________________________________________________________________

    //______METHODE_______________________________________________________________________________________________________________________________________________________________

    function getDao(): IDao
    { // Définie dans la classe abstraite 
        return $this->dao;
    }

    function insert(IEntity $c)
    {
        //Code métier, un compte est forcément un rédacteur
        return $this->dao->insert($c);
    }


    public function findById(int $id): ?Compte
    {
        return $this->dao->findById($id);
    }

    public function delete(int $id){
        return $this->dao->delete($id);
    }


    function login($compte)
    {
        return $this->dao->login($compte);
    }

    function emailIsAlready($email)
    {
        return $this->dao->emailIsAlready($email);
    }

    function pseudoIsAlready($pseudo)
    {
        return $this->dao->pseudoIsAlready($pseudo);
    }
    //______METHODE_______________________________________________________________________________________________________________________________________________________________

}
