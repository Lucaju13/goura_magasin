<?php 

session_start();

if (isset($_SESSION['user'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Ventes</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<br>
			<h1>Vente de produits</h1>
			<div class="row">
				<div class="col-sm-12">
					<span class="btn btn-default" id="ventesProduitBtn">Vendre un Produit</span>
					<span class="btn btn-default" id="ventesRealiseesBtn">Ventes Réalisées</span>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div id="ventesProduit"></div>
					<div id="ventesRealisees"></div>
				</div>
			</div>
		</div>


	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#ventesProduitBtn").click(function(){
				cacherSectionVentes();
				$("#ventesProduit").load('ventes/vendreProduits.php');
				$("#ventesProduit").show();
				
			});
			$("#ventesRealiseesBtn").click(function(){
				cacherSectionVentes();
				$("#ventesRealisees").load('ventes/ventesRealisees.php');
				$("#ventesRealisees").show();
				
			});
		});

		function cacherSectionVentes(){

			$("#ventesProduit").hide();
			$("#ventesRealisees").hide();		
		}
	</script>

	<?php 
}else{
	header("location:../index.php");
}

?>