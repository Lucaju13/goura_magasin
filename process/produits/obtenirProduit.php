<?php 

require_once "../../classes/Connexion.php";
require_once "../../classes/Produits.php";

$obj= new produits();


$idproduit=$_POST['id_produit'];

 echo json_encode($obj->obtenirDonnees($idproduit));

 ?>