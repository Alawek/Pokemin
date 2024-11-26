<?php
//______REQUIRE_______________________________________________________________________________________________________________________________________________________________

require_once(ROOT . "/utils/IDao.php");
require_once(ROOT . "/utils/AbstractDao.php");
require_once(ROOT . "/utils/BddSingleton.php");
require_once(ROOT . "/model/Compte.php");
require_once(ROOT . "/utils/exceptions.php");
require_once(ROOT . "/utils/functions.php");
require_once(ROOT . "/exceptions/ConstraintUniqueException.php");
require_once(ROOT . "/dao/RoleDao.php");
//______REQUIRE_______________________________________________________________________________________________________________________________________________________________



class CompteDao extends AbstractDao implements IDao
{

    //______ATTRIBUT_______________________________________________________________________________________________________________________________________________________________
    private $pdo;
    private RoleDao $roleDao;

    //______ATTRIBUT_______________________________________________________________________________________________________________________________________________________________


    //______CONSTRUCTEUR_______________________________________________________________________________________________________________________________________________________________
    function __construct()
    {
        $this->pdo = BddSingleton::getInstance()->getPDO();
        $this->roleDao=new RoleDao();
    }
    //______CONSTRUCTEUR_______________________________________________________________________________________________________________________________________________________________
    //______METHODE/REQUETE SQL_______________________________________________________________________________________________________________________________________________________________

    public function createFromRow($row, bool $keepPassword = false)
    {
        $compte = new Compte();
        $compte->setIdCompte(intval($row->id_compte));
        $compte->setEmail($row->email);
        $compte->setPseudo($row->pseudo); // ICI
        $compte->setPassword($keepPassword ? $row->password : NULL);
        $compte->setDateCreation(new DateTime($row->date_creation));
        $compte->setRole($this->roleDao->findById($row->id_role));
        return $compte;
    }

    public function create($email, $pseudo, $password)
    {
        $compte = new Compte();
        $compte->setEmail($email);
        $compte->setPseudo($pseudo); // ICI
        $compte->setPassword($password);
        $compte->setDateCreation(new DateTime());
        $compte->setRole($this->roleDao->findById(1));
        return $compte;
    }

    function findById(int $id): ?Compte
    {
        $stmt = $this->pdo->prepare("SELECT * FROM compte c WHERE c.id_compte = :id");
        $stmt->bindParam(':id', $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $row = $stmt->fetch();
        if (! $row) {
            return NULL;
        }
        
        
        $compte = $this->createFromRow($row);


        return $compte;
    }

    function findAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM compte ");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $row = $stmt->fetch();
        if (! $row) {
            return NULL;
        }
        
        $compte = $this->createFromRow($row);


        return $compte;
    }


    function insert(IEntity $compte){
        var_dump($compte);
        $stmt=$this->pdo->prepare("INSERT INTO compte (email,password,pseudo,date_creation,id_role) VALUES ".
                            "(:email,:pwd,:pseudo,:dCreation,:idRole)");
        $stmt->bindValue(':email', $compte->getEmail());
        $stmt->bindValue(':pwd',hashedPassword($compte->getPassword()));
        $stmt->bindValue(':pseudo',$compte->getPseudo());
        $stmt->bindValue(':dCreation',$compte->getDateCreation()->format(MYSQL_DATE_FORMAT));
        $stmt->bindValue(':idRole', $compte->getRole()->getIdRole());
        
        try {
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $ex) {
            $newEx = wrapPDOException($ex);
            // var_dump($newEx);
            throw $newEx;
        }
     }
    function delete(int $id) {
        $stmt=$this->pdo->prepare("DELETE FROM compte WHERE id_compte = :id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($this->findById($id)){
            return "Problème de Suppresion";
        }
        return "Suppression ok";
    }
    function update(IEntity $compte)
    {

        $stmt = $this->pdo->prepare("UPDATE compte SET email=:email, pseudo=:pseudo, password=:password,id_role=:idRole WHERE id_compte=:idCompte");
        $stmt->bindValue(':email', $compte->getEmail());
        $stmt->bindValue(':pseudo', $compte->getPseudo());
        $stmt->bindValue(':password', $compte->getPassword());
        $stmt->bindValue(':idCompte', $compte->getIdcompte(), PDO::PARAM_INT);
        $stmt->bindValue(':idRole',$compte->getRole()->getIdRole());
        $stmt->execute();
    }

    function login($compte)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM compte WHERE email = ?");
        $stmt->bindValue(1, $compte->getEmail());
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $row = $stmt->fetch();
        if (! $row) {
            return NULL;
        }
        if (password_verify($compte->getPassword(), $row->password)) {
            $compte = $this->createFromRow($row);
            return $compte;
        }
        return NULL;
    }

    function emailIsAlready($email){
        $stmt=$this->pdo->prepare("SELECT c.email FROM compte c WHERE c.email= :email");
        $stmt->bindParam(':email',$email);
        $stmt -> setFetchMode(PDO::FETCH_OBJ);
        $stmt-> execute();
        $row = $stmt->fetch();
        if($row){
            return false;
        }else{
            return true;
        }

     }

     function pseudoIsAlready($pseudo){
        $stmt=$this->pdo->prepare("SELECT c.pseudo FROM compte c WHERE c.pseudo= :pseudo");
        $stmt->bindParam(':pseudo',$pseudo);
        $stmt -> setFetchMode(PDO::FETCH_OBJ);
        $stmt-> execute();
        $row = $stmt->fetch();
        if($row){
            return false;
        }else{
            return true;
        }
     }


    //______METHODE/REQUETE_SQL_______________________________________________________________________________________________________________________________________________________________  

}
