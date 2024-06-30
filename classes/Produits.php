<?php 

class produits{

	public function insertImage($donnees){
		$c=new connecter();
		$connexion=$c->connexion();
		$fetch=date('Y-m-d');

		$sql="INSERT into images(
		id_categorie,
		nom,
		route,
		imgCapture
		)
		values (
		'$donnees[0]',
		'$donnees[1]',
		'$donnees[2]',
		'$fetch')";
		$result=mysqli_query($connexion, $sql);

		return mysqli_insert_id($connexion);
	}
	public function insertProduit($donnees){
		$c=new connecter();
		$connexion=$c->connexion();
		$fetch=date('Y-m-d');

		$sql=  "INSERT into produits(
		id_categorie,
		id_image,
		id_users,
		nom,
		description,
		qtd,
		prix,
		produitCapture)
		values ('$donnees[0]',
		'$donnees[1]',
		'$donnees[2]',
		'$donnees[3]',
		'$donnees[4]',
		'$donnees[5]',
		'$donnees[6]',
		'$fetch')";	

		return mysqli_query($connexion, $sql);
	}
	public function obtenirDonnees($idproduit){
		$c=new connecter();
		$connexion=$c->connexion();

		$sql="SELECT id_produit, 
		id_categorie, 
		nom, 
		description, 
		qtd, 
		prix 
		from produits 
		where id_produit='$idproduit'";

		$result=mysqli_query($connexion, $sql);

		$ver=mysqli_fetch_row($result);

		$donnees = array(
			"id_produit"=>$ver[0],
			"id_categorie"=>$ver[1],
			"nom"=>$ver[2],
			"description"=>$ver[3],
			"qtd"=>$ver[4],
			"prix"=>$ver[5]
		);
		return $donnees;
		
	}
	public function updateProduit($donnees){
		$c= new connecter();
		$connexion=$c-> connexion();

		$sql="UPDATE produits set id_categorie ='$donnees[1]',
		nom ='$donnees[2]',
		description ='$donnees[3]',
		qtd ='$donnees[4]',
		prix ='$donnees[5]'
		where id_produit= '$donnees[0]'";
		return mysqli_query($connexion, $sql);
	}
	public function deleteProduit($idProduit){
		$c=new connecter();

		$connexion=$c->connexion();

		$idimage=self::obtenirIdImg($idProduit);

		$sql="DELETE from produits 
		where id_produit='$idProduit'";

		$result=mysqli_query($connexion, $sql);

		if($result){
			$route=self::obtenRouteImage($idimage);
			$sql="DELETE from images 
			where id_image='$idimage'";

			$result= mysqli_query($connexion, $sql);

			if($result){
				if(unlink($route)){
					return 1;
				}
			}
		}

		return mysqli_query($connexion, $sql);
	}
	public function obtenirIdImg($idProduit){
		$c= new connecter();
		$connexion=$c->connexion();

		$sql="SELECT id_image 
		from produits 
		where id_produit='$idProduit'";

		$result=mysqli_query($connexion,$sql);

		return mysqli_fetch_row($result)[0];
	}

	public function obtenRouteImage($idImg){
		$c= new connecter();
		$connexion=$c->connexion();

		$sql="SELECT route 
		from images 
		where id_image='$idImg'";

		$result=mysqli_query($connexion,$sql);

		return mysqli_fetch_row($result)[0];
	}
}

?>