<?php require_once "dependances.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Goura Magasin</title>
</head>
<body style="background-color: white">
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

						<li class="active"><a href="accueil.php"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>

						<?php 
				if ($_SESSION['user']=='admin'):
				 ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Gérer Produits <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="categories.php">Categories</a></li>
							<li><a href="produits.php">Produits</a></li>
						</ul>
					</li>
					<?php 
					endif; ?>


				
				<?php 
				if ($_SESSION['user']=='admin'):
				 ?>
				 <li><a href="users.php"><span class="glyphicon glyphicon-user"></span> Gérer Users</a>
				</li>
				 <?php 
					endif;
				  ?>


				<li><a href="clients.php"><span class="glyphicon glyphicon-user"></span> Clients</a>
				</li>
				<li><a href="ventes.php"><span class="glyphicon glyphicon-eur"></span> Vendre des Articles</a>
				</li>
				<li class="dropdown" >
					<a href="#" style="color: blue"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> User: <?php echo $_SESSION['user']; ?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li> <a style="color: red" href="../process/logout.php"><span class="glyphicon glyphicon-off"></span> Sortir</a></li>

					</ul>
				</li>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
	<!--/.contatiner -->
</div>
</div>

</body>
</html>
<!-- <script type="text/javascript">
	$(window).scroll(function() {
		if ($(document).scrollTop() > 150) {
			alert('hi');
			$('.logo').height(200);

		}
		else {
			$('.logo').height(100);
		}
	});
</script> 
	/!-->

