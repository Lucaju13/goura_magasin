<?php 
require_once "../../classes/Connexion.php";
require_once "../../classes/Ventes.php";

$objv= new ventes();

$c=new connecter();
$connexion=$c-> connexion();

$idvente=$_GET['idvente'];

$sql= "SELECT ve.id_ventes,
			ve.ventesCapture,
			ve.id_client,
			prod.nom,
			prod.prix,
			prod.description
			from ventes  as ve 
			inner join produits as prod
			on ve.id_produit=prod.id_produit
			and ve.id_ventes='$idvente'";

$result=mysqli_query($connexion, $sql);
$ver=mysqli_fetch_row($result);

$folio = $ver[0];
$date = $ver[1];
$cli = $ver[2];


?>
<!DOCTYPE html>
<html>
<head>
	<title>Rapport de Ventes</title>
	<?php require_once "../dependances.php" ?>
</head>
<body>
	<div class="container">
		<div class="">
			<img src="../../images/gouraR.jpg" alt="" width="100px" height="100px">
		</div>
	</div>
	<h2>Goura Magasin</h2>
	<table class="table">
		<tr>
			<td>Date: <?php echo $date ?> </td>
		</tr>
		<tr>
			<td>Portefeuille: <?php echo $folio ?></td>
		</tr>
	</table>
	<p>
		Client: <?php echo $objv->nomClient($cli) ?>
	</p>
	<table class="table" border="1" style="text-align: center;">
		<tr>
			<td>Nom du Produit</td>
			<td>Prix</td>
			<td>Qtd</td>
			<td>Description</td>
		</tr>
		<?php 
		$sql="SELECT ve.id_ventes,
		ve.ventesCapture,
		ve.id_client,
		prod.nom,
		prod.prix,
		prod.description
		from ventes  as ve 
		inner join produits as prod
		on ve.id_produit=prod.id_produit
		and ve.id_ventes='$idvente'";

		$result=mysqli_query($connexion, $sql);
		$total = 0;
		while($afficher=mysqli_fetch_row($result)):
			?>
			<tr>
				<td><?php echo $ver[3] ?></td>
				<td><?php echo $ver[4] ?></td>
				<td>1</td>
				<td><?php echo $ver[5] ?></td>
			</tr>
			<?php 
			$total = $total + $ver[4];
		endwhile; 
		?>
		<tr>
			<td>
				Total: <?php echo $total ?> euro(s)
			</td>
		</tr>
	</table>
</body>
</html>