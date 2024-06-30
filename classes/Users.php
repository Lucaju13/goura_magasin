<?php 

class users {
	public function enregistrerUser($donnees){
		$c=new connecter();
		$connexion=$c->connexion();

		$fetch=date('Y-m-d');

		$sql="INSERT into users (prenom, nom, email, password, userCapture) values ('$donnees[0]',
		'$donnees[1]',
		'$donnees[2]',
		'$donnees[3]', 
		'$fetch')";

		return mysqli_query($connexion, $sql);
	}

	public function loginUser($donnees){
		$c= new connecter();
		$connexion=$c->connexion();
		$password=sha1($donnees[1]);

		$_SESSION['user']=$donnees[0];
		$_SESSION['id_users'] = self::trouverID($donnees);

		$sql="SELECT * 
		from users 
		where email='$donnees[0]'
		and password='$password'";
		$result=mysqli_query($connexion, $sql);

		if(mysqli_num_rows($result) > 0 ){
			return 1;
		}else{
			return 0;
		}
	}
	public function trouverID($donnees){
		$c= new connecter();
		$connexion=$c->connexion();
		$password=sha1($donnees[1]);

		$sql="SELECT id_users from users where email='$donnees[0]'
		and password='$password'";
		$result=mysqli_query($connexion, $sql);

		return mysqli_fetch_row($result)[0];
	}
	public function obtenirDonnes($idUser){
		$c=new connecter();
		$connexion=$c->connexion();

		$sql="SELECT id_users,
		prenom,
		nom,
		email
		from users where id_users='$idUser'";

		$result=mysqli_query($connexion, $sql);

		$ver=mysqli_fetch_row($result);

		$donnes=array(	'id_users'=>$ver[0],
			'prenom'=>$ver[1],
			'nom'=>$ver[2],
			'email'=>$ver[3]
		);
		return $donnes;
	}
	public function updateUser($idUser){
		$c=new connecter();
		$connexion=$c->connexion();

		$sql="UPDATE users set prenom='$idUser[1]',
		nom='$idUser[2]',
		email='$idUser[3]'
		where id_users='$idUser[0]'";

		return mysqli_query($connexion, $sql);
	}

	public function deleteUser($id_user){
		$c=new connecter();
		$connexion=$c->connexion();

		$sql="DELETE from users where id_users='$id_user'";

		return mysqli_query($connexion, $sql);
	}
}


?>