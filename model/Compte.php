<?php
//______REQUIRE_______________________________________________________________________________________________________________________________________________________________

require_once(ROOT . "/utils/IEntity.php");
require_once(ROOT . "/utils/AbstractEntity.php");
//______REQUIRE_______________________________________________________________________________________________________________________________________________________________

class Compte extends AbstractEntity implements IEntity
{
    //______ATTRIBUT_______________________________________________________________________________________________________________________________________________________________
    private $idCompte;
    private $email;
    private $password;
    private $dateCreation;
    private $pseudo;
    //______ATTRIBUT_______________________________________________________________________________________________________________________________________________________________

    //______CONSTRUCTEUR_______________________________________________________________________________________________________________________________________________________________

    function __construct()
    { /* RAS */
    }
    //______CONSTRUCTEUR_______________________________________________________________________________________________________________________________________________________________

    //______GETTER/SETTER_______________________________________________________________________________________________________________________________________________________________

    function getIdCompte(): int
    {
        return $this->idCompte;
    }

    function setIdCompte(int $id)
    {
        $this->idCompte = $id;
    }

    function getEmail(): string
    {
        return $this->email;
    }

    function setEmail(string $email)
    {
        $this->email = $email;
    }

    function getPassword(): string
    {
        return $this->password;
    }

    function setPassword(?string $pwd)
    {
        $this->password = $pwd;
    }

    function getDateCreation(): DateTime
    {
        return $this->dateCreation;
    }

    function setDateCreation(DateTime $date)
    {
        $this->dateCreation = $date;
    }


    function getPseudo(): string
    {
        return $this->pseudo;
    }

    function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;
    }
    //______GETTER/SETTER_______________________________________________________________________________________________________________________________________________________________
    //______METHODE_______________________________________________________________________________________________________________________________________________________________
    //______METHODE_______________________________________________________________________________________________________________________________________________________________
    //______METHODE STATIC_______________________________________________________________________________________________________________________________________________________________	
    // 		public static function createFromRow($row, bool $keepPassword = false) {
    // 			$compte = new Compte();
    // 			$compte->setIdCompte( intval($row->id_compte) );
    // 			$compte->setEmail( $row->email );
    // 			$compte->setPseudo($row->pseudo); // ICI
    // 			$compte->setPassword( $keepPassword ? $row->password : NULL );
    // 			$compte->setDateCreation( new DateTime($row->dateCreation) );
    // 			return $compte;
    // 		}

    // 		public static function create($email, $pseudo, $password) {
    // 			$compte = new Compte();
    // 			$compte->setEmail( $email );
    // 			$compte->setPseudo($pseudo); // ICI
    //             $compte->setPassword( $password );
    //             $compte->setDateCreation( new DateTime() );
    //             return $compte;
    // 		}
    // //______METHODE STATIC_______________________________________________________________________________________________________________________________________________________________




}
