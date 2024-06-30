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
	<style type="text/css">
		
		@page {
			margin-top: 0.3em;
			margin-left: 0.6em;
		}
		body{
			font-size: xx-small;
		}
	</style>
</head>
<body>
	<p>Ticket</p>
	<p>
		Date: <?php echo $date ?>
	</p>
	<p>
		Portefeuille: <?php echo $folio ?>
	</p>
	<p>
		Client: <?php echo $objv->nomClient($cli) ?> 
	</p>
	<table style="border-collapse: collapse;" border = "1">
		<tr>
			<td>Nom: </td>
			<td>Prix: </td>
		</tr>
		<?php 
		$total = 0; 
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
		while($afficher=mysqli_fetch_row($result)):
		?>
		<tr>
			<td><?php echo $afficher[3] ?></td>
			<td><?php echo $afficher[4] ?></td>
		</tr>
	<?php 
		$total = $total + $afficher[4]; 
		endwhile; ?>
	<tr>
		<td>Total: <?php echo $total?> </td>
	</tr>
	</table>
</body>
</html>