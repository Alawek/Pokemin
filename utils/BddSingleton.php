<?php

// le principe de ce design pattern est de s'assurer que je n'aurai qu'une seule
//instance de la classe BddSingleton dans toute mon application.
//pour faire ca , on va rendre le constructeur privé. il ne sera utilisable
//qu'a l'intérieur de la classe avec le mécanisme d'encapsulation
//on accédera a l'unique instance de notre objet par "accés statique"
// PS: ne pas confondre avec static en C qui est un concept totalement différent.

class BddSingleton{

    private static $_INSTANCE = null; //l'unique instance de ma classe
    private $pdo;

    private function __construct(){
        //TODO : coler les parametre de connexion bdd dans un fichier puis include
        try{
            $this->pdo = new PDO(DSN,USERNAME,PASSWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4') );
            //Activation des messages d'erreur PDO, car il n'est pas assez bavard
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch (PDOException $e){
            error_log($e);
            _500_Internal_Server_Error("DB connection error" . $e->getMessage());
        }

    }

    //l'accès a mon singleton
    public static function getInstance() : BddSingleton {
        //Ici on fait ce qu'on appele un lazy initialization
        //Je crée à la volée en gros
        if (is_null(self::$_INSTANCE)){
            self::$_INSTANCE = new BddSingleton();
        }
        return self::$_INSTANCE;

    }

    public function getPDO() : PDO {
        return $this->pdo;

    }

    function __destruct(){//appelé automatiquement a la destruction de mon singleton
        unset($this->pdo);
    }


}
?>