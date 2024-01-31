<?php
	
	require_once "classes/Connexion.php";
	$obj= new connecter();
	$connexion=$obj-> connexion();

	$sql="SELECT * from users where email='admin'";
	$result=mysqli_query($connexion, $sql);
	$valider=0;
	if (mysqli_num_rows($result) > 0){
		$valider=1;
	} 

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login - Goura Magasin</title>
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="js/functions.js"></script>

</head>
<body style="background-color: grey">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
				Système de ventes - Goura Magasin
				</div>
				<div class="class panel panel-body">
					<p>
						<img src="images/goura.jpg"height="190px">
					</p>
					<form id="frmLogin" >
						<label>Username</label>
						<input type="text" class="form-control input-sm" name="user" id="user">	
						<label>Password</label>
						<input type="password" class="form-control input-sm" name="password" id="password">
							<p></p>
						<span class="btn btn-primary btn-sm" id="connexion">Connexion</span>
						<?php if (!$valider): ?>
						<a href="enregistrer.php" class="btn btn-danger btn-sm">Enregistrer</a>
					<?php  endif; ?>
					</form>		
				</div>
			</div>

			</div>
			<div class="col-sm-4"></div>
		</div>
	
	</div>

</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#connexion').click(function(){

			vide=validerFormVide('frmLogin');

			if(vide > 0){
				alert("Il faut repmlir toutes les champs!!");
				return false;
			}

			donnes=$('#frmLogin').serialize();
			$.ajax({
				type:"POST",
				data:donnes,
				url:"process/regLogin/login.php",
				success:function(r){
					alert(r);

					if(r==1){
						window.location="affichages/clients.php";
					}else{
						alert("Échec de connexion :(");
					}
				}
			});
		});
	});
</script>