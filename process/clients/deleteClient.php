<?php 
require_once "../../classes/Connexion.php";
require_once "../../classes/Clients.php";

$obj= new clients();

$idc=$_POST['id_client'];

echo $obj->delClient($idc);



 ?>