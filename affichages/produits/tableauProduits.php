<?php 
	require_once "../../classes/Connexion.php";
	$c=new connecter();
	$connexion=$c->connexion();

	$sql="SELECT prod.nom, 
				 prod.description, 
				 prod.qtd, 
				 prod.prix,
				 img.route,
				 cat.nomCategorie,
				 prod.id_produit 
	from produits as prod 
	inner join images as img
	on prod.id_image=img.id_image
	inner join categories as cat on 
	prod.id_categorie=cat.id_categorie";

	$result=mysqli_query($connexion, $sql);
 ?>
<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<caption><label>Produits</label></caption>
		<tr>
			<td>Nom</td>
			<td>Description</td>
			<td>Quantité</td>
			<td>Prix (€)</td>
			<td>Image</td>
			<td>Categorie</td>
			<td>Modifier</td>
			<td>Suprimer</td>
		</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
		<tr>
			<td><?php echo $ver[0] ?></td>
			<td><?php echo $ver[1] ?></td>
			<td><?php echo $ver[2] ?></td>
			<td><?php echo $ver[3] ?></td>
			<td>
				<?php 
					$imgVer=explode("/", $ver[4]) ;
					$imgRoute=$imgVer[1]."/".$imgVer[2]."/".$imgVer[3];	
				?>
			<img width="80" height="80" src="<?php echo $imgRoute ?>">	
				</td>
			<td><?php echo $ver[5] ?></td>
			<td>
				<span class = "btn btn-warning btn-xs">
					<span data-toggle="modal" data-target="#modalUpdateProduit"class="glyphicon glyphicon-pencil" onclick="donneesProduit('<?php echo $ver[6] ?>')"></span>
				</span>
			</td>
			<td>
				<span class = "btn btn-danger btn-xs">
					<span class="glyphicon glyphicon-remove" onclick="deleteProduit('<?php echo $ver[6] ?>')"></span>
				</span>
			</td>
		</tr>
		<?php endwhile; ?>
	</table>
	
</div>