	<table class="tab_rouge_575">
		<tr>
			<td class="titre_fond_rouge25" valign="top" colspan="5">
				Demande incomplete
			</td>
		</tr>
		<tr>
			<td class="cell_100">Reference</td>
			<td class="cell_360">Designation</td>
			<td class="cell_37_5">Qte</td>
			<td class="cell_37_5">Recu</td>
			<td class="cell_40">Stock</td>
		</tr>

<?php

	$num_demande = '';
	if(isset($_POST['ajax']))
	{
		include('connect.php');
		
		$num_demande = $_POST['num_demande'];
	}
	else
	{
		$num_demande = $_GET['num_dem'];
	}
	
	

	$sql_conso = "SELECT *
				  FROM CONSOMMABLE AS C, DEMANDER AS DEM
				  WHERE C.REFERENCE = DEM.REFERENCE
				  AND NUM_DEMANDE = " .$num_demande;
	$res_c = mysql_query($sql_conso);
	
	while($conso = mysql_fetch_array($res_c))
	{
		$sql_consomme = "SELECT *
						 FROM CONSOMMER AS C, DEMANDE AS D
						 WHERE C.NUM_DEMANDE = D.NUM_DEMANDE
						 AND D.NUM_DEMANDE = " .$num_demande ." "
					   ."AND C.REFERENCE = '" .$conso['REFERENCE'] ."';";
		$res_con = mysql_query($sql_consomme)or die($sql_consomme);
		$consomme = mysql_fetch_array($res_con);
		
		echo '<tr>';
		echo '<td>' .$conso['REFERENCE'] .'</td>';
		echo '<td>' .$conso['DESIGNATION'] .'</td>';
		echo '<td align="center">' .$conso['QTE_DEMANDER'] .'</td>';
		if($consomme['NB_CONSO'] < $conso['QTE_DEMANDER'])
			echo '<td class="rouge" align="center">' .$consomme['NB_CONSO'] .'</td>';
		else
			echo '<td align="center">' .$consomme['NB_CONSO'] .'</td>';
		echo '<td align="center">' .$conso['QTE_STOCK'] .'</td>';
		echo '</tr>';
			
	
	
	}
	
	
?>

	<tr>
		<td colspan="5" class="titre_fond_rouge25">
		<?php
		
			$fichier = split("/", $_SERVER['SCRIPT_NAME']);
			$n = count($fichier);
		
			if($fichier[$n-1] != "afficher_demande.php")
			{
		?>
			<input type="button" name="finir_traiter" id="finir_traiter_bout" value="Finir le traitement" class="bouton_rouge" onclick="Finir_traiter_demande(<?php echo $num_demande; ?>);"/>
		<?php
		
			}
		
		?>
		
		</td>
	</tr>

	</table>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	