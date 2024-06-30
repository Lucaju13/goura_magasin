<?php 
require_once "../../classes/Connexion.php";
require_once "../../classes/Ventes.php";

$obj= new ventes();

echo json_encode($obj->obtDonnesProd($_POST['produit']));
 ?>