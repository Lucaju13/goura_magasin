<?php 
require_once "Connexion.php";

class clients {

	public function addClient($donnes){
		$c=new connecter();
		$connexion=$c->connexion();
		$iduser=$_SESSION['user'];

		$sql= "INSERT into clients (id_users,
		prenom,
		nom,
		adresse,
		email,
		tel,
		rfc)
		values('$iduser',
		'$donnes[0]',
		'$donnes[1]',
		'$donnes[2]',
		'$donnes[3]',
		'$donnes[4]',
		'$donnes[5]'
	)";

	return mysqli_query($connexion, $sql);

}
public function obtenirClient($idclient){
	$c=new connecter();
	$connexion=$c->connexion();
	$sql="SELECT id_client,
	prenom,
	nom,
	adresse,
	email,
	tel,
	rfc 
	from clients where id_client='$idclient' ";
	$result= mysqli_query($connexion, $sql);
	$ver=mysqli_fetch_row($result);

	$donnes= array ('id_client'=>$ver[0],
		'prenom'=>$ver[1],
		'nom'=>$ver[2],
		'adresse'=>$ver[3],
		'email'=>$ver[4],
		'tel'=>$ver[5],
		'rfc'=>$ver[6] );
	return $donnes;
}
	//Actualizer client
public function updateClient($idclient){
	$c=new connecter();
	$connexion=$c->connexion();

	$sql="UPDATE clients set prenom='$idclient[1]',
	nom='$idclient[2]',
	adresse='$idclient[3]',
	email='$idclient[4]',
	tel='$idclient[5]',
	rfc='$idclient[6]'
	where id_client='$idclient[0]'";
	return mysqli_query($connexion, $sql);

}
//Method pour eliminer le client
public function delClient($idclient){
	$c=new connecter();
	$connexion=$c->connexion();

	$sql = "DELETE from clients where id_client='$idclient'";

	return mysqli_query($connexion, $sql);

}



}


?>