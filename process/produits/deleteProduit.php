<?php 
require_once "../../classes/Connexion.php";
require_once "../../classes/Produits.php";

$idProd=$_POST['id_produit'];

$obj= new produits();

echo $obj->deleteProduit($idProd);


?>