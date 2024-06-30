<?php 
session_start();
$iduser=$_SESSION['id_users'];
require_once "../../classes/Connexion.php";
require_once "../../classes/Produits.php";

$obj = new produits();

$donnees=array();

$nomImage=$_FILES['image']['name'];
$routeTemp=$_FILES['image']['tmp_name'];
$dossier='../../files/';
$routeFinal=$dossier.$nomImage;

$donneesImg=array($_POST['categorieSelect'],
	$nomImage,
	$routeFinal
);

if(move_uploaded_file($routeTemp, $routeFinal)){
	 $idimg=$obj->insertImage($donneesImg);

	 if ($idimg > 0){
	 	$donnees[0]=$_POST['categorieSelect'];
	 	$donnees[1]=$idimg;
	 	$donnees[2]=$iduser;
	 	$donnees[3]=$_POST['nom'];
	 	$donnees[4]=$_POST['description'];
	 	$donnees[5]=$_POST['quantite'];
	 	$donnees[6]=$_POST['prix'];

	 	echo $obj->insertProduit($donnees);

	 }else{
	 	echo 0;
	 }
}

?>