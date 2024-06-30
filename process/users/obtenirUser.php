<?php 

	require_once "../../classes/Connexion.php";
	require_once "../../classes/Users.php";

	$obj=new users();
	$idu=$_POST['id_user'];
	
	echo json_encode($obj->obtenirDonnes($idu));

 ?>