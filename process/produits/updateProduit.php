<?php 
require_once "../../classes/Connexion.php";
require_once "../../classes/Produits.php";

$obj= new produits();
$donnees=array(
			$_POST['idproduit'],
		    $_POST['categorieSelectU'], 
		    $_POST['nomU'],
		    $_POST['descriptionU'], 
		    $_POST['quantiteU'],
		    $_POST['prixU'] 
		);
echo $obj->updateProduit($donnees);
	

 ?>