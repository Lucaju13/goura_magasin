<?php 
session_start();

require_once "../../classes/Connexion.php";
require_once "../../classes/Categories.php";

$donnees=array($_POST['idCategorie'],
				$_POST['categorieU']
					);

$obj = new categories();

echo $obj->updateCategorie($donnees);

 ?>