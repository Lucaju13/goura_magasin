<?php 
require_once "../../classes/Connexion.php";
require_once "../../classes/Categories.php";

$id=$_POST['idCategorie'];

$obj= new categories();

echo $obj->deleteCategorie($id);

?>