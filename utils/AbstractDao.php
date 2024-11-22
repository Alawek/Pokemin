<?php
require_once(ROOT . "/utils/IDao.php");

abstract class AbstractDao implements IDao{

    function findAll(){throw new Exception("Not Implemented");}

    function findById(int $id) : ?IEntity{throw new Exception("Not Implemented");}

    function getDao() : IDao{throw new Exception("Not Implemented");}

    function insert(IEntity $entity){throw new Exception("Not Implemented");}

    function delete(int $id){throw new Exception("Not Implemented");}

    function update(IEntity $entity){throw new Exception("Not Implemented");}

}
