
<style type="text/css">
		
@page {
            margin-top: 0.3em;
            margin-left: 0.6em;
        }
	</style>

<script type="text/javascript">

	//script para evento click y ajax 
	$('#').click(function(){

		donnees=$('#').serialize();
		$.ajax({
			type:"POST",
			data:donnees,
			url:"../process/",
			success:function(r){

			}
		});
	});
//////////////funcion para validar datos vacios :)
	function validerFormVide(formulaire){
		datas=$('#' + formulaire).serialize();
		d=datas.split('&');
		vides=0;
		for(i=0;i< d.length;i++){
				controles=d[i].split("=");
				if(controles[1]=="A" || controles[1]==""){
					vides++;
				}
		}
		return vides;
	}

</script>

<script type="text/javascript">
		$('#').click(function(){
			var formData = new FormData(document.getElementById("frm"));

				$.ajax({
					url: "../process/produit/insertProduit.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(data){
						
						if(data == 1){
							$('#frm')[0].reset();
							$('#tableauProduits').load('produits/tableauProduits.php');
							alertify.success("Reussit :D");
						}else{
							alertify.error("Il y a un erreur :(");
						}
					}
				});
		});
</script>

<?php 

	public function obtenIdImg($idProducto){
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

		public function creaFolio(){
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

	///***************************************
	public function nomClient($idCliente){
		$c= new connecter();
		$connexion=$c->connexion();

		$sql="SELECT prenom,nom 
			from clients 
			where id_client='$idClient'";
		$result=mysqli_query($connexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}

	public function obtenirTotal($idventa){
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

 ?>