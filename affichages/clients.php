<?php 
session_start();

if (isset($_SESSION['user'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Clients</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<br>
			<h1>Clients</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmClient">
						<label>Prenom</label>
						<input type="text" class="form-control input-sm" id="prenom" name="prenom">
						<label>Nom</label>
						<input type="text" class="form-control input-sm" id="nom" name="nom">	
						<label>Adresse</label>
						<input type="text" class="form-control input-sm" id="adresse" name="adresse">	
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="email" name="email">	
						<label>Tel</label>
						<input type="text" class="form-control input-sm" id="tel" name="tel">	
						<label>RFC</label>
						<input type="text" class="form-control input-sm" id="rfc" name="rfc">

						<p></p>
						<span class="btn btn-primary" id="btnAjouterClient">Entregistrer</span>	

					</form>
				</div>
				<div class="col-sm-8">
					<div id="tableauClientLoad"></div>

				</div>
			</div>

		</div>

		<!-- Modal -->
		<div class="modal fade" id="modalClientUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizer Clients</h4>
					</div>
					<div class="modal-body">
						<form id="frmClientU">
							<input type="text" name="id_clientU" id="id_clientU" hidden="">
							<label>Prenom</label>
							<input type="text" class="form-control input-sm" id="prenomU" name="prenomU">
							<label>Nom</label>
							<input type="text" class="form-control input-sm" id="nomU" name="nomU">	
							<label>Adresse</label>
							<input type="text" class="form-control input-sm" id="adresseU" name="adresseU">	
							<label>Email</label>
							<input type="text" class="form-control input-sm" id="emailU" name="emailU">	
							<label>Tel</label>
							<input type="text" class="form-control input-sm" id="telU" name="telU">	
							<label>RFC</label>
							<input type="text" class="form-control input-sm" id="rfcU" name="rfcU">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal" id="btnActualizerClient">Sauver</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>
	<!-- Obtenir donnes du client dans la base de donnees apartir du script /!-->
	<script type="text/javascript">
		function donnesClient(id_client){
			$.ajax({
				type:"POST",
				data:"id_client="+ id_client,
				url:"../process/clients/obtenirClient.php",
				success:function(r){
					
					donn=jQuery.parseJSON(r);
					$("#id_clientU").val(donn['id_client']);
					$("#prenomU").val(donn['prenom']);
					$("#nomU").val(donn['nom']);
					$("#adresseU").val(donn['adresse']);
					$("#emailU").val(donn['email']);
					$("#telU").val(donn['tel']);
					$("#rfcU").val(donn['rfc']);
				}
			});
		}
		
	</script>
	<!-- Script pour ajouter un client a la base de donnees /!-->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tableauClientLoad").load("clients/tableauClients.php");

			$('#btnAjouterClient').click(function(){

				vide=validerFormVide('frmClient');

				if(vide > 0){
					alertify.alert("Il faut repmlir toutes les champs!!");
					return false;
				}

				donnes=$('#frmClient').serialize();
				$.ajax({
					type:"POST",
					data:donnes,
					url:"../process/clients/ajouterClients.php",
					success:function(r){
						alert(r);

						if(r==1){
							$('#frmClient')[0].reset();
							$("#tableauClientLoad").load("clients/tableauClients.php");
							alertify.success("Client enregistré avec succès :)");
						}else{
							alertify.error("Échec de l'enregistrement :(");
						}
					}
				});
			});

			
		});
	</script>
	<!-- script pour update le client /!-->
	<script type="text/javascript">
		$(document).ready(function(){

			$('#btnActualizerClient').click(function(){

				donnees=$('#frmClientU').serialize();
				$.ajax({
					type:"POST",
					data:donnees,
					url:"../process/clients/updateClient.php",
					success:function(r){
						
						if (r==1){
							$("#tableauClientLoad").load("clients/tableauClients.php");
							alertify.success("Mise à jour réussie :)");
						}else{
							alertify.error("échec de mise à jour :(");
						}
						

					}
				});
			});

		});
	</script>
	<!-- script pour eliminer le client /!-->
	<script type="text/javascript">
		function deleteClient(id_client){
			alertify.confirm('Voulez-vous supprimer cette Client ?', function(){
				$.ajax({
					type:"POST",
					data:"id_client="+ id_client,
					url:"../process/clients/deleteClient.php",
					success:function(r){
						if (r==1){
							$("#tableauClientLoad").load("clients/tableauClients.php");
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