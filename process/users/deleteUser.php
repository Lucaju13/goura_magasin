<?php 
require_once "../../classes/Connexion.php";
require_once "../../classes/Users.php";

$obj = new users();

echo $obj->deleteUser($_POST['id_user']);

?>