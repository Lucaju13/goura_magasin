<?php 
	
	require_once "../../classes/Connexion.php";
	require_once "../../classes/Users.php";

	$obj= new users();
	$pass = sha1($_POST['password']);

	$donnees=array (
		$_POST['prenom'],
		$_POST['nom'], 
		$_POST['user'],
		$pass
				);

	echo $obj->enregistrerUser($donnees);

 ?>