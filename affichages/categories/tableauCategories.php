<?php 
require_once "../../classes/Connexion.php";
$c = new connecter();
$connexion=$c->connexion();

$sql="SELECT id_categorie, nomCategorie 
		FROM categories";
$result = mysqli_query($connexion, $sql);
 ?>
<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption>
		<label>Categories :D</label>
	</caption>
	<tr>
		<td>Categories</td>
		<td>Modifier</td>
		<td>Suprimer</td>
	</tr>
	<?php 
	while ($ver=mysqli_fetch_row($result)):?>
	<tr>
		<td><?php echo $ver[1] ?></td>
		<td>
			<span class = "btn btn-warning btn-xs"data-toggle="modal" data-target="#actualizerCategorie">
				<span class="glyphicon glyphicon-pencil" onclick="ajouterDonnees('<?php echo $ver[0] ?>','<?php echo $ver[1] ?>')"></span>
			</span>
		</td>
		<td>
			<span class = "btn btn-danger btn-xs">
				<span class="glyphicon glyphicon-remove" onclick="deleteCategorie('<?php echo $ver[0] ?>','<?php echo $ver[1] ?>')"></span>
			</span>
		</td>
	</tr>
<?php endwhile;?>
</table>