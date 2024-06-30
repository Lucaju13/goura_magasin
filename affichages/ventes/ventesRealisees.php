<?php 
require_once "../../classes/Connexion.php";
require_once "../../classes/Ventes.php";
$c= new connecter();
$connexion = $c-> connexion();
$obj = new ventes();

$sql="SELECT id_ventes,ventesCapture, id_client from ventes group by id_ventes";
$result = mysqli_query($connexion, $sql);
?>
<h4>Ventes Réalisées</h4>
<div class="container">	
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
					<caption><label>Rapport des Ventes</label></caption>
					<tr>
						<td>Folio</td>
						<td>Date</td>
						<td>Client</td>
						<td>Total Achat</td>
						<td>Ticket</td>
						<td>Rapport</td>

					</tr>
					<?php while($ver=mysqli_fetch_row($result)): ?>
						<tr>
							<td><?php echo $ver[0] ?></td>
							<td><?php echo $ver[1] ?></td>
							<td>
								<?php if($obj->nomClient($ver[2])==" "){
									echo "S/C";
								}else{
									echo $obj->nomClient($ver[2]);
								} 
								?>
							</td>
							<td>
								<?php 
								echo $obj->obtenirTotal($ver[0]);
								?>
							</td>
							<td>
								<a href="../process/ventes/creerTicketPDF.php?idvente=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
									Ticket <span class="glyphicon glyphicon-list-alt"></span>
								</a>
							</td>
							<td>
								<a href="../process/ventes/creerRapportPDF.php?idvente=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
									Rapport <span class="glyphicon glyphicon-file"></span>
								</a>
							</td>

						</tr>
					<?php endwhile; ?>	
				</table>

			</div>
		</div>
		<div class="col-sm-1"></div>
	</div>	
</div>

