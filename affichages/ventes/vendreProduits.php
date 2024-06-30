<?php 
require_once "../../classes/Connexion.php";
$c= new connecter();
$connexion=$c-> connexion();
?>

<h4>Vendre un Produit</h4>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<form id="frmVendreProduit">
				<label>Choisir Client</label>
				<select class="form-control input-sm" id="client" name="client">
					<option value="A">Choisissez</option>
					<option value="0">Pas de client</option>
					<?php
					$sql = "SELECT id_client, prenom, nom
					from clients ";
					$result=mysqli_query($connexion, $sql);

					while($client=mysqli_fetch_row($result)):
						?>
						<option value="<?php echo $client[0] ?>"><?php echo $client[2]." ".$client[1] ?></option>
					<?php endwhile; ?>
				</select>
				<label>Produit</label>
				<select class="form-control input-sm" id="produit" name="produit">
					<option value="A">Choisissez</option>
					<?php 
					$sql="SELECT id_produit, nom
					from produits";
					$result=mysqli_query($connexion, $sql);
					while ($produit=mysqli_fetch_row($result)):
						?>
						<option value="<?php echo $produit[0]?>"><?php echo $produit[1];?></option>
					<?php endwhile; ?>
				</select>
				<label>Description</label>
				<textarea readonly="" class="form-control input-sm" id="descriptionV" name="descriptionV"></textarea>
				<label>Quantité</label>
				<input readonly="" type="text" class="form-control input-sm" id="quantiteV" name="quantiteV">
				<label>Prix</label>
				<input readonly="" type="text" class="form-control input-sm" id="prixV" name="prixV">
				<p></p>
				<span class="btn btn-primary" id="btnVendre">Ajouter au Panier</span>
				<span class="btn btn-danger" id="viderPanier">Vider Panier</span>
			</form>
		</div>
		<div class="col-sm-3">
			<div id="imgProduit"></div>		
		</div>
		<div class="col-sm-5">
			<div id="produitTempLoad"></div>
		</div>	
	</div>
</div>


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
		$('#btnVendre').click(function(){
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
				alertify.success("Produit supprimé :D");

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