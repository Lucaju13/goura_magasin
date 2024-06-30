<?php 
session_start();

require_once "../../classes/Connexion.php";
require_once "../../classes/Categories.php";

$fetch=date("Y-m-d");

$id_users=$_SESSION['id_users'];
$categorie=$_POST['categories'];

$donnees=array($id_users, 
				$categorie, 
				$fetch
				);

$obj = new categories();
echo $obj->ajouterCategorie($donnees);

?>