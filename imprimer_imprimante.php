<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimer imprimante</title>
<link rel="stylesheet" type="text/css" href="site.css"/>
</head>

<body>

	<?php
	
		include('connect.php');
		
		if(isset($_GET['ref_impr']))
		{
		
			$sql_impr = "SELECT * FROM IMPRIMANTE WHERE REF_IMPRIMANTE = '" .$_GET['ref_impr'] ."';";
			$res_i = mysql_query($sql_impr)or die($sql_impr);
			
			if(mysql_num_rows($res_i))
			{
				$imprimante = mysql_fetch_array($res_i);
	
	?>

				<table class="tab_bleu_575">
					<tr>
						<td class="titre_fond_bleu25" valign="top" colspan="2">
							Fiche Imprimante
						</td>
					</tr>
					<tr>
						<td class="cell_100_simple">Type</td>
						<td class="cell_500_simple">
						<?php
						
							$sql_select = "SELECT * FROM TYPE_IMPRIMANTE WHERE ID_TYPE_IMPR = " .$imprimante['ID_TYPE_IMPR'] .";";
							$res_t = mysql_query($sql_select);
							$type_i = mysql_fetch_array($res_t);
							echo $type_i['LIB_TYPE_IMPR'];
												
						?>
												
						</td>
					</tr>
					<tr>
						<td class="cell_100_simple">Marque</td>
						<td class="cell_500_simple">
						<?php
						
							$sql_m = "SELECT * FROM MARQUE WHERE ID_MARQUE = " .$imprimante['ID_MARQUE'] .";";
							$res_m = mysql_query($sql_m);
							$marque = mysql_fetch_array($res_m);
							echo $marque['LIBELLE_MARQUE'];
													
						?>
						</td>
					</tr>
					<tr>
						<td class="cell_100_simple">R&eacute;f&eacute;rence</td>
						<td class="cell_500_simple"><?php echo $imprimante['REF_IMPRIMANTE']; ?></td>
					</tr>
					<tr>
						<td class="cell_100_simple">D&eacute;signation</td>
						<td class="cell_500_simple"><?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?></td>
					</tr>
									
			
	<?php
	
				$sql_divs = "SELECT *
							 FROM SERVICE AS S, DIVISION AS D, IMPR_EN_SERVICE AS I
							 WHERE I.ID_SERVICE = S.ID_SERVICE
							 AND S.ID_DIVISION = D.ID_DIVISION
							 AND I.REF_IMPRIMANTE = '" .$imprimante['REF_IMPRIMANTE'] ."';";
							  
				$res_ds = mysql_query($sql_divs);
				if(mysql_num_rows($res_ds) > 0)
				{
				
	?>
					<tr>
						<td class="titre_fond_bleu25" valign="top" colspan="2">
							Service possedant cette imprimante
						</td>
					</tr>
					<tr>
						<td colspan="2">
	
							<table class="tab_ass_conso">
							<tr>
								<td class="cell_242">Division</td>
								<td class="cell_243">Service</td>
								<td class="cell_90">Annee</td>
								
							</tr>
	
	<?php
	
							while($ds = mysql_fetch_array($res_ds))
							{
										
								echo '<tr>';
								echo '<td align="center">' .$ds['ID_DIVISION'] .'</td>';
								echo '<td align="center">' .$ds['ID_SERVICE'] .'</td>';
								echo '<td align="center">' .$ds['ANNEE_MISE_EN_SERVICE'] .'</td>';
								echo '</tr>';
												
							
							}
							
							
							echo '</table>';
					echo '</td></tr>';
			
				}
	
	
				echo '</table>';
		
	
	
			}
			else
			{
				echo "<center>Aucun imprimante ne possede cette reference.</center>";
			
			}
	
		}
		else
		{
			echo "<center>Aucune reference d'imprimante n'a ete fourni à la page.</center>";
		
		}
	
	?>



</body>
</html>
