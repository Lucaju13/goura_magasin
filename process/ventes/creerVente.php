<?php 
session_start();
require_once "../../classes/Connexion.php";
require_once "../../classes/Ventes.php";

$obj= new ventes();


if (count($_SESSION['produitTemp'])==0){
	echo 0;
}else{
	$result=$obj->creerVentes();
	unset($_SESSION['produitTemp']);
	echo $result;
}


?>