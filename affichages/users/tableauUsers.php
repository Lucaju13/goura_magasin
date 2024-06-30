<?php 
	require_once "../../classes/Connexion.php";
	$c=new connecter();
	$connexion=$c->connexion();

	$sql="SELECT id_users,
				prenom,
				nom,
				email
			from users";

	$result=mysqli_query($connexion, $sql);

?>
<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption>
		<label>Utilisateurs</label>
	</caption>
	<tr>
		<td>Prenom</td>
		<td>Nom</td>
		<td>Username/E-mail</td>
		<td>Modifier</td>
		<td>Suprimer</td>
	</tr>
	<?php while($ver=mysqli_fetch_row($result)): ?>
	<tr>
	<td><?php echo $ver[1] ?></td>
	<td><?php echo $ver[2] ?></td>
	<td><?php echo $ver[3] ?></td>
	<td>
		<span class = "btn btn-warning btn-xs" onclick="donnesUser('<?php echo $ver[0]; ?>')"data-toggle="modal" data-target="#udpateUserModal">
			<span class="glyphicon glyphicon-pencil"></span>
		</span>
	</td>
	<td>
		<span class = "btn btn-danger btn-xs" onclick="deleteUsers('<?php echo $ver[0]; ?>')">
			<span class="glyphicon glyphicon-remove"></span>
		</span>
	</td>
</tr>
	<?php endwhile; ?>
</table>