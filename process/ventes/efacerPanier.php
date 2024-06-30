<?php 
session_start();
$index = $_POST['ind'];
unset($_SESSION['produitTemp'][$index]);

$donnees=array_values($_SESSION['produitTemp']); //Pour re-indexer les elements
unset($_SESSION['produitTemp']);
$_SESSION['produitTemp']=$donnees;
 ?>