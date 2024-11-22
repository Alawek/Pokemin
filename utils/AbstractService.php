<?php
require_once(ROOT . "/utils/IService.php");
require_once(ROOT . "/utils/IDao.php");

abstract class AbstractService implements Iservice{
    //Chaque Service concret me fournira son DAO
    //Le polymorphisme fera le boulot
    abstract function getDao() : IDao;

    function findAll(){
        return $this->getDao()->findAll();
    }

    function findById(int $id) : ?IEntity{
        return $this->getDao()->findById($id);
    }
    

    function insert(IEntity $entity){
        return $this->getDao()->insert($entity);
    }

    function delete(int $id){
        $this->getDao()->delete($id);
    }

    function update(IEntity $entity){
        $this->getDao()->update($entity);
    }
}
