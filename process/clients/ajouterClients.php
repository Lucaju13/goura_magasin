<?php 
session_start();
require_once "../../classes/Connexion.php";
require_once "../../classes/Clients.php";


$obj = new clients();

$clients = array(	$_POST['prenom'],
					$_POST['nom'],
					$_POST['adresse'],
					$_POST['email'],
					$_POST['tel'],
					$_POST['rfc']
);

echo $obj->addClient($clients);


?>