<?php 
session_start();

require_once "../../classes/Connexion.php";
require_once "../../classes/Clients.php";

$obj= new clients();

$donnes= array($_POST['id_clientU'],
				$_POST['prenomU'],
				$_POST['nomU'],
				$_POST['adresseU'],
				$_POST['emailU'],
				$_POST['telU'],
				$_POST['rfcU']
				);
echo $obj->updateClient($donnes);
?>