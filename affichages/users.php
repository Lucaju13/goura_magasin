<?php 
session_start();

if (isset($_SESSION['user']) and $_SESSION['user']=='admin' ){

	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Users</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<br>
			<h1>Gestion de Utilisateurs</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmEnregistrer" >
						<label>Prenom</label>
						<input type="text" class="form-control input-sm" name="prenom" id="prenom">
						<label>Nom</label>
						<input type="text" class="form-control input-sm" name="nom" id="nom">
						<label>Username/E-mail</label>
						<input type="text" class="form-control input-sm" name="user" id="user">
						<label>Password</label>
						<input type="text" class="form-control input-sm" name="password" id="password">
						<p></p>
						<span class="btn btn-primary" id="enregistrer">Enregistrer</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tableauUserLoad"></div>

				</div>
			</div>

		</div>
		<!-- Modal -->
		<div class="modal fade" id="udpateUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizer User</h4>
					</div>
					<div class="modal-body">
						<form id="frmEnregistrerU" >

							<input type="text" hidden="" name="id_user" id="id_user">
							<label>Prenom</label>
							<input type="text" class="form-control input-sm" name="prenomU" id="prenomU">
							<label>Nom</label>
							<input type="text" class="form-control input-sm" name="nomU" id="nomU">
							<label>Username/E-mail</label>
							<input type="text" class="form-control input-sm" name="userU" id="userU">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal" id="btnUpdateUser">Actualizer</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>
	<script type="text/javascript">
		function donnesUser(id_user){
			$.ajax({
				type:"POST",
				data:"id_user="+ id_user,
				url:"../process/users/obtenirUser.php",
				success:function(r){
					
					donn=jQuery.parseJSON(r);
					$("#id_user").val(donn['id_users']);
					$("#prenomU").val(donn['prenom']);
					$("#nomU").val(donn['nom']);
					$("#userU").val(donn['email']);
				}
			});
		}
	</script>

	<!--Script pour userUpdate /!-->
	<script type="text/javascript">
		$(document).ready(function(){
				$('#btnUpdateUser').click(function(){
					donnees=$('#frmEnregistrerU').serialize();
					$.ajax({
						type:"POST",
						data:donnees,
						url:"../process/users/updateUser.php",
						success:function(r){
							if(r==1){
								$("#tableauUserLoad").load("users/tableauUsers.php");
								alertify.success("Actualizé avec succès :)");
							}else{
								alertify.error("Échec de l'actualization :(");
							}
						}
					});
				});

			});
		</script>

		<!--Script pour enregistrer user /!-->
		<script type="text/javascript">
			$(document).ready(function(){
				$("#tableauUserLoad").load("users/tableauUsers.php");

				$('#enregistrer').click(function(){

					vide=validerFormVide('frmEnregistrer');

					if(vide > 0){
						alertify.alert("Il faut repmlir toutes les champs!!");
						return false;
					}

					donnes=$('#frmEnregistrer').serialize();
					$.ajax({
						type:"POST",
						data:donnes,
						url:"../process/regLogin/enregistrerUser.php",
						success:function(r){
						//alert(r);

						if(r==1){
							$('#frmEnregistrer')[0].reset();
							$("#tableauUserLoad").load("users/tableauUsers.php");
							alertify.success("enregistré avec succès :)");
						}else{
							alertify.error("Échec de l'enregistrement :(");
						}
					}
				});
				});
			});
		</script>
		<!--Script pour suprimer le user /!-->
		<script type="text/javascript">
			function deleteUsers(id_user){
			alertify.confirm('Voulez-vous supprimer cette User ?', function(){
				$.ajax({
					type:"POST",
					data:"id_user="+ id_user,
					url:"../process/users/deleteUser.php",
					success:function(r){
						if (r==1){
							$("#tableauUserLoad").load("users/tableauUsers.php");
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