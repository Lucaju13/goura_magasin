<?php
	
	require_once "classes/Connexion.php";
	$obj= new connecter();
	$connexion=$obj-> connexion();

	$sql="SELECT * from users where email='admin'";
	$result=mysqli_query($connexion, $sql);
	$valider=0;
	if (mysqli_num_rows($result) > 0){
		header("location: index.php");
	} 

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Engresitrez-Vous</title>
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
	<script src="js/functions.js"></script>
	<script src="lib/jquery-3.2.1.min.js"></script>

</head>
<body style="background-color: grey">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
			<div class="panel panel-danger">
				<div class="panel panel-heading">Enregistrer</div>
				<div class="panel panel-body">
					<form id="frmEnregistrer">
						<label>Prenom</label>
						<input type="text" class="form-control input-sm" name="prenom" id="prenom">
						<label>Nom</label>
						<input type="text" class="form-control input-sm" name="nom" id="nom">
						<label>Username</label>
						<input type="text" class="form-control input-sm" name="user" id="user">
						<label>Password</label>
						<input type="password" class="form-control input-sm" name="password" id="password">
						<p></p>
						<span class="btn btn-primary" id="enregistrer">Enregistrer</span>
						<a href="index.php" class="btn btn-default">Connecter</a>
					</form>
				</div>
		</div>
	</div>
	<div class="col-sm-4"></div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#enregistrer').click(function(){

			vide=validerFormVide('frmEnregistrer');

			if(vide > 0){
				alert("Il faut repmlir toutes les champs!!");
				return false;
			}

			donnes=$('#frmEnregistrer').serialize();
			$.ajax({
				type:"POST",
				data:donnes,
				url:"process/regLogin/enregistrerUser.php",
				success:function(r){
					alert(r);

					if(r==1){
						alert("enregistré avec succès :)");
					}else{
						alert("Échec de l'enregistrement :(");
					}
				}
			});
		});
	});
</script>
