<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimer consommable</title>
<link rel="stylesheet" type="text/css" href="site.css"/>
</head>

<body>

	<?php
	
		include('connect.php');
		
		if(isset($_GET['ref_conso']))
		{
		
			$sql_conso = "SELECT * FROM CONSOMMABLE WHERE REFERENCE = '" .$_GET['ref_conso'] ."';";
			$res_c = mysql_query($sql_conso)or die($sql_conso);
			
			if(mysql_num_rows($res_c))
			{
				$conso = mysql_fetch_array($res_c);
	
	?>

				<table class="tab_bleu_575">
					<tr>
						<td class="titre_fond_bleu25" valign="top" colspan="2">
							Fiche consommable
						</td>
					</tr>
					<tr>
						<td class="cell_100_simple">Type</td>
						<td class="cell_500_simple">
						<?php
						
							$sql_select = "SELECT * FROM TYPE_CONSO WHERE ID_TYPE = " .$conso['ID_TYPE'] .";";
							$res_t = mysql_query($sql_select);
							$type_c = mysql_fetch_array($res_t);
							echo $type_c['LIBELLE_TYPE'];
												
						?>
												
						</td>
					</tr>
					<tr>
						<td class="cell_100_simple">R&eacute;f&eacute;rence</td>
						<td class="cell_500_simple"><?php echo $conso['REFERENCE']; ?></td>
					</tr>
					<tr>
						<td class="cell_100_simple">D&eacute;signation</td>
						<td class="cell_500_simple"><?php echo $conso['DESIGNATION']; ?></td>
					</tr>
					<tr>
						<td class="cell_100_simple">Prix Total</td>
						<td class="cell_500_simple">
							<?php echo $conso['PRIX_UNITAIRE'] * $conso['LOT']; ?>
							&#8364; par lot de
							<?php echo $conso['LOT']; ?>
							
						</td>
					</tr>
					<tr>
						<td class="cell_100_simple">Prix unitaire</td>
						<td class="cell_500_simple">
							<?php echo round($conso['PRIX_UNITAIRE'], 2) ."&#8364;"; ?>
						</td>
					
					</tr>
					<tr>
						<td class="cell_100_simple">TVA</td>
						<td class="cell_500_simple">
						<?php
						
							$sql_tva = "SELECT * FROM TVA WHERE CODE_TVA = " .$conso['CODE_TVA'] .";";
							$res_t = mysql_query($sql_tva);
							$tva = mysql_fetch_array($res_t);
							echo $tva['TAUX_TVA'];
													
						?>
						</td>
					</tr>
					<tr>
						<td>Qte stock</td>
						<td><?php echo $conso['QTE_STOCK']; ?></td>
					</tr>	
					<tr>
						<td>Seuil r&eacute;apro</td>
						<td><?php echo $conso['SEUIL_REAP']; ?></td>
					</tr>
					
					<tr>
						<td valign="top">Commentaire</td>
						<td>
							<?php echo substr($conso['COMMENTAIRE'], 0, 50); ?><br/>
							<?php echo substr($conso['COMMENTAIRE'], 50, 50); ?><br/>
							<?php echo substr($conso['COMMENTAIRE'], 100, 50); ?><br/>
							<?php echo substr($conso['COMMENTAIRE'], 150, 50); ?><br/>
							<?php echo substr($conso['COMMENTAIRE'], 200, 50); ?><br/>
							<?php echo substr($conso['COMMENTAIRE'], 250, 50); ?>
						</td>
					</tr>
				
			
	<?php
	
				$sql_impr = "SELECT *
							  FROM IMPRIMANTE AS I, ASSOCIER AS A
							  WHERE I.REF_IMPRIMANTE = A.REF_IMPRIMANTE
							  AND A.REFERENCE = '" .$conso['REFERENCE'] ."';";
							  
				$res_a = mysql_query($sql_impr);
				if(mysql_num_rows($res_a) > 0)
				{
				
	?>
					<tr>
						<td class="titre_fond_bleu25" valign="top" colspan="2">
							Imprimante associer au consommable
						</td>
					</tr>
					<tr>
						<td colspan="2">
	
							<table class="tab_ass_conso">
							<tr>
								<td class="cell_75">Reference</td>
								<td class="cell_500">Designation</td>
							</tr>
	
	<?php
	
							while($impr = mysql_fetch_array($res_a))
							{
										
								echo '<tr>';
								echo '<td>' .$impr['REF_IMPRIMANTE'] .'</td>';
								echo '<td>' .$impr['DESIGNATION_IMPRIMANTE'] .'</td>';
								echo '</tr>';
							
							
							}
							
							
							echo '</table>';
					echo '</td></tr>';
			
				}
	
	
				echo '</table>';
		
	
	
			}
			else
			{
				echo "<center>Aucun consommable ne possede cette reference.</center>";
			
			}
	
		}
		else
		{
			echo "<center>Aucun numero de consommable n'a ete fourni à la page.</center>";
		
		}
	
	?>



</body>
</html>
