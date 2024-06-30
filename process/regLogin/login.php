<?php 
	session_start();
	require_once "../../classes/Connexion.php";
	require_once "../../classes/Users.php";

	$obj= new users();
	$donnees=array($_POST['user'],
				  $_POST['password']
					);

	echo $obj->loginUser($donnees);


 ?>