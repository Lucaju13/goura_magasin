<?php 
session_start();

if (isset($_SESSION['user'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Produits</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../classes/Connexion.php";
		$c= new connecter();
		$connexion=$c->connexion();
		$sql="SELECT id_categorie, nomCategorie from categories"; 
		$result=mysqli_query($connexion, $sql);

		?>
	</head>
	<body>
		<div class="container">
			<br>
			<h1>Produits</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmProduit" enctype="multipart/form-data">
						<label>Categorie</label>
						<select class="form-control input-sm" id="categorieSelect" name="categorieSelect">
							<option value="A">Choisissez une catégorie</option>
							<?php while($ver=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>	
							<?php endwhile;  ?>
						</select>
						<label>Nom</label>
						<input type="text" class="form-control input-sm" id="nom" name="nom">
						<label>Description</label>
						<textarea type="text" class="form-control input-sm" id="description" name="description"></textarea>
						<label>Quantité</label>
						<input type="text" class="form-control input-sm" id="quantite" name="quantite">
						<label>Prix</label>
						<input type="text" class="form-control input-sm" id="prix" name="prix">
						<label>Image</label>
						<input type="file" id="image" name="image">
						<p></p>
						<span id="btnAjouterProduit" class="btn btn-primary">Ajouter</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tableauProduitLoad"></div>

				</div>
			</div>
		</div>
		<div class="modal fade" id="modalUpdateProduit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizer Produit</h4>
					</div>
					<div class="modal-body">
						<form id="frmProduitUpdate" enctype="multipart/form-data">
							<input type="text" hidden="" id="idproduit" name="idproduit">
							<label>Categorie</label>
							<select class="form-control input-sm" id="categorieSelectU" name="categorieSelectU">
								<option value="A">Choisissez une catégorie</option>
								<?php 
								$sql="SELECT id_categorie, nomCategorie from categories"; 
								$result=mysqli_query($connexion, $sql); ?>
								<?php while($ver=mysqli_fetch_row($result)): 
									?>
									<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>	
								<?php endwhile;  ?>
							</select>
							<label>Nom</label>
							<input type="text" class="form-control input-sm" id="nomU" name="nomU">
							<label>Description</label>
							<textarea type="text" class="form-control input-sm" id="descriptionU" name="descriptionU"></textarea>
							<label>Quantité</label>
							<input type="text" class="form-control input-sm" id="quantiteU" name="quantiteU">
							<label>Prix</label>
							<input type="text" class="form-control input-sm" id="prixU" name="prixU">
							<p></p>
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizerProduit" type="button" class="btn btn-warning" data-dismiss="modal">Actualizer</button>
					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function donneesProduit(idproduit){
			$.ajax({
				type:"POST",
				data:"id_produit="+ idproduit,
				url:"../process/produits/obtenirProduit.php",
				success:function(r){
					
					donn=jQuery.parseJSON(r);
					$("#idproduit").val(donn['id_produit']);
					$("#categorieSelectU").val(donn['id_categorie']);
					$("#nomU").val(donn['nom']);
					$("#descriptionU").val(donn['description']);
					$("#quantiteU").val(donn['qtd']);
					$("#prixU").val(donn['prix']);

				}
			});
		}
		function deleteProduit(idProduit){
			alertify.confirm('Voulez-vous supprimer cette Produit ?', function(){
				$.ajax({
					type:"POST",
					data:"id_produit="+ idProduit,
					url:"../process/produits/deleteProduit.php",
					success:function(r){
						if (r==1){
							$("#tableauProduitLoad").load("produits/tableauProduits.php");
							alertify.success('Élimination réussie :)');
						}else{
							alertify.error('Défaut de suppression :(');
						}

					}
				}); 
			}, 
			function(){
				alertify.error('Opération annulée!!')
			});	
		}
	</script>
		<script type="text/javascript">
		$(document).ready(function(){

			$('#btnActualizerProduit').click(function(){

				donnees=$('#frmProduitUpdate').serialize();
				$.ajax({
					type:"POST",
					data:donnees,
					url:"../process/produits/updateProduit.php",
					success:function(r){
						
							if (r==1){
								$("#tableauProduitLoad").load("produits/tableauProduits.php");
								alertify.success("Mise à jour réussie :)");
							}else{
								alertify.error("échec de mise à jour :(");
							}
						

					}
				});
			});

		});
	</script>


	<script type="text/javascript">
		$(document).ready(function(){
			$("#tableauProduitLoad").load("produits/tableauProduits.php");

			$('#btnAjouterProduit').click(function(){

				vide=validerFormVide('frmProduit');

				if(vide > 0){
					alertify.alert("Il faut repmlir toutes les champs!!");
					return false;
				}

				var formData = new FormData(document.getElementById("frmProduit"));

				$.ajax({
					url: "../process/produits/ajouterProduit.php",
					type: "POST",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(r){
						alert(r);

						if(data == 1){
							$('#frmProduit')[0].reset();
							$("#tableauProduitLoad").load("produits/tableauProduits.php");

							alertify.success("Reussit :D");
						}else{
							alertify.error("Il y a un erreur :(");
						}
					}
				});
			});
		});
	</script>

	<?php 
}else{
	header("location:../index.php");
}

?>