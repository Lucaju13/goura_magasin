<?php
session_start(); 
require_once "../../classes/Connexion.php";
$c= new connecter();
$connexion=$c->connexion();

$idclient=$_POST['client'];
$idproduit=$_POST['produit'];
$description=$_POST['descriptionV'];
$qtd=$_POST['quantiteV'];
$prix=$_POST['prixV'];

$sql="SELECT prenom, nom
			from clients 
			where id_client='$idclient'";

$result=mysqli_query($connexion, $sql);

$cl = mysqli_fetch_row($result);

$nclient=$cl[1]." ".$cl[0];

$sql="SELECT nom from produits where id_produit = '$idproduit'";

$result=mysqli_query($connexion, $sql);

$nProduit = mysqli_fetch_row($result)[0];

$produit = $idproduit."||".
			$nProduit."||".
			$description."||".
			$prix."||".
			$nclient."||".
			$idclient;

$_SESSION['produitTemp'][]=$produit;
?>