<?php 
require_once "../../classes/Connexion.php";
	$c=new connecter();
	$connexion=$c->connexion();
	$sql="SELECT id_client, 
				prenom, 
				nom, 
				adresse, 
				email, 
				tel, 
				rfc 
	from clients";

$result= mysqli_query($connexion, $sql);
?>
<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Clients</label></caption>
	<tr>
		<td>Prenom</td>
		<td>Nom</td>
		<td>Adresse</td>
		<td>Email</td>
		<td>Tel</td>
		<td>RFC</td>
		<td>Modifier</td>
		<td>Suprimer</td>
	</tr>
	<?php while($ver=mysqli_fetch_row($result)):  ?>
	<tr>
		<td><?php echo $ver[1]; ?></td>
		<td><?php echo $ver[2]; ?></td>
		<td><?php echo $ver[3]; ?></td>
		<td><?php echo $ver[4]; ?></td>
		<td><?php echo $ver[5]; ?></td>
		<td><?php echo $ver[6]; ?></td>
	
		<td>
			<span class = "btn btn-warning btn-xs" data-toggle="modal" data-target="#modalClientUpdate" onclick="donnesClient('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class = "btn btn-danger btn-xs">
				<span class="glyphicon glyphicon-remove" onclick="deleteClient('<?php echo $ver[0]; ?>')"></span>
			</span>
		</td>

	</tr>
<?php endwhile; ?>
</table>