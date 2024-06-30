<?php 
session_start();

if (isset($_SESSION['user'])){

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Goura Magasin</title>
	<?php require_once "home.php"; ?>
</head>
<body>	

</body>
</html>
<?php 
	}else{
		header("location:../index.php");
	}

 ?>