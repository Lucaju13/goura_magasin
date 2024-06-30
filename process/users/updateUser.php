<?php 
require_once "../../classes/Connexion.php";
require_once "../../classes/Users.php";

$obj=new users();

$user=array($_POST['id_user'],
			$_POST['prenomU'],
			$_POST['nomU'],
			$_POST['userU']
			);
echo $obj->updateUser($user);


 ?>