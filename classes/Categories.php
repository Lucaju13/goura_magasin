<?php 
class categories {
	public function ajouterCategorie($donnees){
		$c = new connecter();
		$connexion=$c->connexion();

		$sql="INSERT into categories(id_users,
		nomCategorie,
		categorieCapture)
		values ('$donnees[0]',
		'$donnees[1]',
		'$donnees[2]')";

		return mysqli_query($connexion, $sql);
	}

	public function updateCategorie($donnees){
		$c=new connecter();
		$connexion=$c->connexion();

		$sql="UPDATE categories set nomCategorie='$donnees[1]' where id_categorie='$donnees[0]'";

		echo mysqli_query($connexion, $sql);
	}

	public function deleteCategorie($idCategorie){
		$c=new connecter();
		$connexion=$c->connexion();
		$sql="DELETE from categories where id_categorie='$idCategorie'";
		return mysqli_query($connexion, $sql);
	}
}

?>