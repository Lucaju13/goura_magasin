<?php 
require_once "../../classes/Connexion.php";
require_once "../../classes/Clients.php";

$obj= new clients();

echo json_encode($obj->obtenirClient($_POST['id_client']));

?>