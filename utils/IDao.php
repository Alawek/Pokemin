<?php

interface IDao{
    function findAll();

    function findById(int $id) : ?IEntity;

    function getDao() : IDao;

    function insert(IEntity $entity);

    function delete(int $id);

    function update(IEntity $entity);


}
