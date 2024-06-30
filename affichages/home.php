<?php require_once "dependances.php"; 
?>
<?php 
require_once "../classes/Connexion.php";
$c=new connecter();
$connexion=$c->connexion();

$sql="SELECT prod.nom, 
prod.description, 
prod.qtd, 
prod.prix,
img.route,
cat.nomCategorie,
prod.id_produit 
from produits as prod 
inner join images as img
on prod.id_image=img.id_image
inner join categories as cat on 
prod.id_categorie=cat.id_categorie";

$result=mysqli_query($connexion, $sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Goura Magasin</title>
</head>
<!-- Begin Navbar -->
<div id="nav">
	<div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
		<div class="container">
			<div class="navbar-header12">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="accueil.php"><img class="img-responsive logo img-thumbnail" src="../images/goura.jpg" alt="" width="100px" height="100px"></a>
			</div>

			<div id="navbar" class="collapse navbar-collapse">

				<ul class="nav navbar-nav navbar-right">

				<!--	<li class="active"><a href="accueil.php"><span class="glyphicon glyphicon-home"></span> Accueil</a></li> -->

					<li>
						<a href="../enregistrer.php" style="color: blue"  class="glyphicon glyphicon-user"> Connecter</a>
					</li>
					
				</ul>

			</div>

			<!--/.nav-collapse -->
		</div>
		<!--/.contatiner -->
	</div>
	<br><br>
	<hr></hr>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-9">
			<?php while($ver=mysqli_fetch_row($result)): ?>
				<div class="box" style="display: inline-block; margin-right: 100px; ">
					<?php 
					$imgVer=explode("/", $ver[4]) ;
					$imgRoute=$imgVer[1]."/".$imgVer[2]."/".$imgVer[3];	
					?>
					<a href="produits/viewProduit.php"><img width="150px" style="position: relative;" height="150px" src="<?php echo $imgRoute ?>"/></a>

					<div class="card-body p-4">
						<div class="text-center">
							<!-- Product name-->
							<h5 class="fw-bolder"><?php echo $ver[0] ?></h5>
							<!-- Product price-->
							<?php echo $ver[3] ?> €
						</div>
					</div>
					<p></p>
					<div class="card-footer p-4 pt-0 border-top-0 bg-transparent" id="btnAjouter">
						<div class="text-center"><span class="btn btn-warning btn-sm" href="#">Ajouter au Panier</span></div>
					</div>

				</div>
			<?php endwhile; ?>
		</div>
		
	</div>
	
</div>

</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#produitTempLoad").load("ventes/produitTemp.php");

		$('#produit').change(function(){
			donnees=$('#frmVendreProduit').serialize();
			$.ajax({
				type:"POST",
				data:"produit="+ $('#produit').val(),
				url:"../process/ventes/frmProduit.php",
				success:function(r){
					donn=jQuery.parseJSON(r);
					$('#descriptionV').val(donn['description']);
					$('#quantiteV').val(donn['qtd']);
					$('#prixV').val(donn['prix']);
					$('#imgProduit').prepend('<img class="img-thumbnail" id="imgP" src="'+ donn['route'] + '" />');

				}
			});	
		});
		$('#btnAjouter').click(function(){
			vide=validerFormVide('frmVendreProduit');
			if(vide > 0){
				alertify.alert("Il faut repmlir toutes les champs!!");
				return false;
			}

			donnees=$('#frmVendreProduit').serialize();
			$.ajax({
				type:"POST",
				data:donnees,
				url:"../process/ventes/vendreProduitTemp.php",
				success:function(r){
					$("#produitTempLoad").load("ventes/produitTemp.php");

				}
			});
		});
		$('#viderPanier').click(function(){
			$.ajax({
				url:"../process/ventes/viderPainer.php",
				success:function(r){
					$("#produitTempLoad").load("ventes/produitTemp.php");

				}
			});
		});
	});
</script>

<script type="text/javascript">
	function efacerP (index){
		$.ajax({
			type:"POST",
			data:"ind="+ index,
			url:"../process/ventes/efacerPanier.php",
			success:function(r){
				$("#produitTempLoad").load("ventes/produitTemp.php");
				alertify.success("Produit annulé :D");

			}
		});
	}
	function creerV(){
		$.ajax({
			url:"../process/ventes/creerVente.php",
			success:function(r){
				if(r > 0){
					$("#produitTempLoad").load("ventes/produitTemp.php");
					$("#frmVendreProduit")[0].reset();
					alertify.alert("Vente crée avec succès, regardez les details en Ventes Realisées!!");
				}else if (r == 0){
					alertify.alert("Il y a pas de ventes!");
				}else{
					alertify.error("Pas Possible de creer la vente :(");
				}

			}
		});
	}

</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#client').select2();
		$('#produit').select2();



	});
	
</script>