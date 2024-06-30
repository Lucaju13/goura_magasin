<?php 
session_start();

?>
<h4>Panier</h4>
<h4><strong><div id="nomClient"></div></strong></h4>
<table class="table table-border table-hover table-condensed" style="text-align: center;">
	<caption>
		<span class="btn btn-success" onclick="creerV()">Vendre 
			<span class="glyphicon glyphicon-euro"></span>
		</span>
	</caption>
	<tr>
		<td>Nom</td>
		<td>Description</td>
		<td>Prix</td>
		<td>Quantite</td>
		<td>Effacer</td>
	</tr>
	<?php 
		$total = 0; //ce variable aura le total de achats en € 
		$client=" "; //ce variable garde le nom du client

		if (isset($_SESSION['produitTemp'])):
			$i=0;

			foreach (@$_SESSION['produitTemp'] as $key){
				$d = explode("||", @$key);
		?>

		<tr>
			<td><?php echo $d[1] ?></td>
			<td><?php echo $d[2] ?></td>
			<td><?php echo $d[3] ?></td>
			<td><?php echo 1; ?></td>
			<td>
				<span class="btn btn-danger btn-xs" onclick="efacerP ('<?php echo $i; ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
		</tr>
	<?php
	$i++;
	$total = $total + $d[3];
	$client=$d[4];
		}
		endif;
	?>
	<tr>
		<td>Total: <?php echo "€".$total; ?></td>
	</tr>
</table>
<script type="text/javascript">
	$(document).ready(function(){
		nom="<?php echo @$client ?>";
		$("#nomClient").text("Nom du client: "+nom);	
	});
</script>

