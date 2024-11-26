<?php
define("ROOT", dirname(__FILE__)); // on veut une constante pour chemin de chargement on pourrait rajoute . "/" pour initialiser un slash et ne pas etre obligè de l'ecrire a chaque require.
require_once(ROOT ."/_config.php");
require_once(ROOT . '/utils/functions.php'); // chargement de la caisse à outils
require_once(ROOT . '/utils/session.php');
manageSession();
var_dump($_SESSION);
$FORM = extractForm();
// Dans TOUS les formulaires, je veux un paramètre route
$ROUTE = extractRoute($FORM);
// J'ai maintenant une route potable, je créer le controlleur et je l'exécute
$CONTROLLER = createController($FORM, $ROUTE);
$CONTROLLER->execute();



	 // chargement de la caisse à outils
	

// $myLeo= new Leo();
// $myFelix=new Felix();
// $mySquirteuse= new Squirteuse();

// echo $myLeo->name . ' est de type : ' . $myLeo->type . '<br>';

// echo $myLeo->crier() . '<br>';
// echo $myLeo->aFaim() . '<br>';
// echo $myLeo->manger() . '<br>';
// echo $myLeo->aFaim() . '<br>';
// echo $myLeo->crier() . '<br>';

// echo $myLeo->attaqueUn() . '<br>';
// echo $myFelix->subir($myLeo->degat1). '<br>';
// echo $myFelix->attaqueDeux() . '<br>';
// echo $myLeo->subir($myFelix->degat2). '<br>';
// echo $myLeo->attaqueDeux(). '<br>';
// echo $myFelix->subir($myLeo->degat2). '<br>';
// echo $myFelix->attaqueDeux() . '<br>';
// echo $myLeo->subir($myFelix->degat2). '<br>';
// echo $myLeo->attaqueDeux(). '<br>';
// echo $myFelix->subir($myLeo->degat2). '<br>';
// echo $myFelix->attaqueDeux() . '<br>';
// echo $myLeo->subir($myFelix->degat2). '<br>';
// echo $myLeo->estFatiguer() . "<br>";
// echo $myLeo->dormir() . "<br>";
// echo $myLeo->estFatiguer() . "<br>";
// echo $myFelix->dormir(). "<br>";
// echo $myFelix->estFatiguer() . "<br>";

// echo $myFelix->attaqueDeux(). "<br>";
// echo $mySquirteuse->subir($myFelix->degat2) . "<br>";
// echo $mySquirteuse->attaqueTrois() . "<br>";
// echo $mySquirteuse->crier();




