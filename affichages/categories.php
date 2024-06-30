<?php 
session_start();

if (isset($_SESSION['user'])){

	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Categories</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<br>
			<h1>Categories</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmCategories">
						<label>Categories</label>
						<input type="text" name="categories" class="form-control input-sm" id="categories">
						<p></p>
						<span class="btn btn-primary" id="btnAjouter">Ajouter</span>	
					</form>	
				</div>

				<div class = "col-sm-6">
					<div id="tableauCategorieLoad"></div>
				</div>
				
			</div>
		</div>
		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="actualizerCategorie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizer Categorie</h4>
					</div>
					<div class="modal-body">
						<form id="frmCategorieUpdate">
							<input type="text" hidden="" id="idCategorie"name="idCategorie">
							<label>Categorie</label>
							<input type="text" id="categorieU" name="categorieU" class="form-control input-sm">

						</form>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal" id="btnActualizer">Sauver</button>
					</div>
				</div>
			</div>
		</div>


	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tableauCategorieLoad").load("categories/tableauCategories.php");

			$('#btnAjouter').click(function(){

				vide=validerFormVide('frmCategories');

				if(vide > 0){
					alertify.alert("Il faut repmlir toutes les champs!!");
					return false;
				}

				donnes=$('#frmCategories').serialize();
				$.ajax({
					type:"POST",
					data:donnes,
					url:"../process/categories/ajouterCategories.php",
					success:function(r){
						alert(r);

						if(r==1){

						//cest command nous permet de  nettoyer le formulaire
						$("#frmCategories")[0].reset();

						$("#tableauCategorieLoad").load("categories/tableauCategories.php");
						alertify.success("Categorie enregistré avec succès :)");
					}else{
						alertify.error("Échec de l'enregistrement :(");
					}
				}
			});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			//script para evento click y ajax 
			$('#btnActualizer').click(function(){

				donnees=$('#frmCategorieUpdate').serialize();
				$.ajax({
					type:"POST",
					data:donnees,
					url:"../process/categories/updateCategorie.php",
					success:function(r){
						if(r==1){
							$("#tableauCategorieLoad").load("categories/tableauCategories.php");
							alertify.success("La catégorie a été mise à jour avec succès :)");
						}else{
							alertify.error("Échec de la mise à jour :(");
						}

					}
				});
			});

		});
	</script>

	<script type="text/javascript">
		function ajouterDonnees(idCategorie, categorie){
			$("#idCategorie").val(idCategorie);
			$("#categorieU").val(categorie);
		}
		function deleteCategorie(idCategorie){
			alertify.confirm('Voulez-vous supprimer cette catégorie ?', function(){
				$.ajax({
					type:"POST",
					data:"idCategorie="+ idCategorie,
					url:"../process/categories/deleteCategorie.php",
					success:function(r){
						if (r==1){
							$("#tableauCategorieLoad").load("categories/tableauCategories.php");
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
	<?php 
}else{
	header("location:../index.php");
}

?>