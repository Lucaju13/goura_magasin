<?php 
class ventes {
	public function obtDonnesProd($idProd){
		$c= new connecter();
		$connexion=$c-> connexion();

		$sql="SELECT prod.id_produit,
		prod.nom, 
		prod.description, 
		prod.qtd, 
		prod.prix,
		img.route
		from produits as prod 
		inner join images as img
		on prod.id_image=img.id_image and
		prod.id_produit='$idProd'";
		$result=mysqli_query($connexion, $sql);
		$ver=mysqli_fetch_row($result);
		$imgVer=explode("/", $ver[5]);
		$imgRoute=$imgVer[1]."/".$imgVer[2]."/".$imgVer[3];

		$donn= array('nom'=>$ver[1],
			'description'=>$ver[2],
			'qtd'=>$ver[3],
			'prix'=>$ver[4],
			'route'=>$imgRoute
		);
		return $donn;
	}
	public function creerVentes(){
		$c= new connecter();
		$connexion=$c->connexion();

		$fetch = date('Y-m-d');
		$idvente = self::creerFolio();
		$donnees=$_SESSION['produitTemp'];
		$r=0; //tout les reponses que nous allons retourner
		$iduser = $_SESSION['id_users'];

		for ($i=0; $i<count($donnees); $i++){
			
			$d = explode("||", $donnees[$i]);

			$sql="INSERT into ventes (id_ventes,
			id_client,
			id_produit,
			id_users,
			prix,
			ventesCapture)

			values ('$idvente',
			'$d[5]',
			'$d[0]',
			'$iduser',
			'$d[3]',
			'$fetch')";

			$r = $r + $result=mysqli_query($connexion, $sql);
			self::eliminerQTD($d[0], 1);
		}
		return $r;

	}
	public function eliminerQTD($idProduit, $qtd){
		$c= new connecter();
		$connexion=$c->connexion();

		$sql="SELECT qtd from produits
		where id_produit='$idProduit'";

		$result=mysqli_query($connexion, $sql);
		$quantite=mysqli_fetch_row($result)[0];
		$newQtd=abs($qtd - $quantite);

		$sql="UPDATE produits set qtd='$newQtd'
		where id_produit='$idProduit'";	

	}
	public function creerFolio(){
		$c= new connecter();
		$connexion=$c->connexion();

		$sql="SELECT id_ventes from ventes group by id_ventes desc";

		$resul=mysqli_query($connexion,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}
	public function nomClient($idClient){
		$c= new connecter();
		$connexion=$c->connexion();

		$sql="SELECT prenom, nom 
		from clients 
		where id_client='$idClient'";

		$result=mysqli_query($connexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}

	public function obtenirTotal($idvente){
		$c= new connecter();
		$connexion=$c->connexion();

		$sql="SELECT prix 
		from ventes 
		where id_ventes='$idvente'";

		$result=mysqli_query($connexion,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	} 

}

?>