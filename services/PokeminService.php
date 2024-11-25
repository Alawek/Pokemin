<?php
//______REQUIRE_______________________________________________________________________________________________________________________________________________________________
require_once(ROOT . "/utils/IService.php");
require_once(ROOT . "/utils/AbstractService.php");
require_once(ROOT . "/utils/IDao.php");
require_once(ROOT . "/dao/PokeminDao.php");
require_once(ROOT . "/model/Pokemin.php");
//______REQUIRE_______________________________________________________________________________________________________________________________________________________________



class PokeminService extends AbstractService implements IService
{
    //______ATTRIBUT_______________________________________________________________________________________________________________________________________________________________

    private PokeminDao $dao;

    //______ATTRIBUT_______________________________________________________________________________________________________________________________________________________________
    //______CONSTRUCTEUR_______________________________________________________________________________________________________________________________________________________________

    function __construct()
    {
        $this->dao = new PokeminDao();
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


    public function findById(int $id): ?Pokemin
    {
        return $this->dao->findById($id);
    }

    public function delete(int $id){
        return $this->dao->delete($id);
    }

    public function update(IEntity $pokemin){
        return $this->dao->update($pokemin);
    }

    
    //______METHODE_______________________________________________________________________________________________________________________________________________________________

}
