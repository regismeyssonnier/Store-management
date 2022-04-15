<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimer liste consommable</title>
<link rel="stylesheet" type="text/css" href="site.css"/>
</head>

<body>

	<?php
	
		include('connect.php');
	
		if( isset($_GET['sql_impr']) )
		{
				
	?>

			<table class="tab_conso">
			<tr>
				<td align="center" colspan="5" class="titre_fond_bleu25">
					Liste des imprimantes 
					<?php 
						if(isset($_GET['division']))
						{
							if($_GET['division'] == 'Toute')
								echo "de la division " .$_GET['sel_div'];
							else
								echo "de la division " .$_GET['division'];
						}
						if(isset($_GET['service']))echo "du service " .$_GET['service'];
					?>
				</td>
			</tr>
			
	<?php
			
			if(@$_GET['division'] == 'Toute')
			{
				echo '<tr>';
				echo '<td align="center" colspan="5" class="titre_fond_bleu25">';
				echo $_GET['sel_div'];
				echo '</td></tr>';
				$sel_div = $_GET['sel_div'];
				
				
				$sql_s = "SELECT * FROM SERVICE WHERE ID_DIVISION = '" .$sel_div ."';";
				$res_s = mysql_query($sql_s);
				
				while($service = mysql_fetch_array($res_s))
				{
					echo '<tr>';
					echo '<td align="center" colspan="5" class="titre_fond_blanc">';
					echo $service['ID_SERVICE'];
					echo '</td></tr>';
					
	?>
					<tr>
						<td class="cell_ref_tab_impr_ser">R&eacute;f&eacute;rence</td>
						<td class="cell_des_tab_impr_ser">D&eacute;signation</td>
						<td class="cell_marque_tab_impr_ser">Marque</td>
						<td class="cell_type_tab_impr_ser">Type</td>
						<td class="cell_annee_tab_impr_ser">Nb</td>
						
					</tr>
				
	<?php

					$blanc = true;
																		 
					$sql_impr = "SELECT I.REF_IMPRIMANTE, DESIGNATION_IMPRIMANTE, LIBELLE_MARQUE, LIB_TYPE_IMPR, COUNT(*)
								 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T, IMPR_EN_SERVICE AS IES
								 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
								 AND I.ID_MARQUE = M.ID_MARQUE 
								 AND I.REF_IMPRIMANTE = IES.REF_IMPRIMANTE
								 AND IES.ID_SERVICE = '" .$service['ID_SERVICE'] ."' 
								 GROUP BY REF_IMPRIMANTE ";
								 
					$res_i = mysql_query($sql_impr);
					if(mysql_num_rows($res_i) > 0)
					{
							
						while($imprimante = mysql_fetch_array($res_i))
						{
																			
							if($blanc)
							{
				
	?>
								<tr>
									<td class="cell_tab_blanche"><?php echo $imprimante['REF_IMPRIMANTE']; ?></td>
									<td class="cell_tab_blanche"><?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?></td>
									<td class="cell_tab_blanche"><?php echo $imprimante['LIBELLE_MARQUE']; ?></td>
									<td class="cell_tab_blanche"><?php echo $imprimante['LIB_TYPE_IMPR']; ?></td>
									<td class="cell_tab_blanche"><?php echo $imprimante[4]; ?></td>
															
								</tr>



	<?php
					
								$blanc = false;
						
							}
							else
							{
				
	?>

								<tr>
									<td class="cell_tab_bleu"><?php echo $imprimante['REF_IMPRIMANTE']; ?></td>
									<td class="cell_tab_bleu"><?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?></td>
									<td class="cell_tab_bleu"><?php echo $imprimante['LIBELLE_MARQUE']; ?></td>
									<td class="cell_tab_bleu"><?php echo $imprimante['LIB_TYPE_IMPR']; ?></td>
									<td class="cell_tab_bleu"><?php echo $imprimante[4]; ?></td>
																				
								</tr>



	<?php
								$blanc = true;
					
							}
				


			
			
						}
			

						
						
						
					}
					else
					{
						echo '<tr><td colspan=5" align="center">Aucune imprimante dans ce service</td></tr>';
					
					}
					
					
			
				}
			
			}
			else
			{
			
	?>
			
			
				<tr>
					<td class="cell_ref_tab_impr_ser">R&eacute;f&eacute;rence</td>
					<td class="cell_des_tab_impr_ser">D&eacute;signation</td>
					<td class="cell_marque_tab_impr_ser">Marque</td>
					<td class="cell_type_tab_impr_ser">Type</td>
					<td class="cell_annee_tab_impr_ser">Nb</td>
					
				</tr>
		
	<?php
	
				$res_impr = mysql_query(stripslashes($_GET['sql_impr']));
					
				$blanc = true;
				
				while($imprimante = mysql_fetch_array($res_impr))
				{
																
					if($blanc)
					{
			
	?>
						<tr>
							<td class="cell_tab_blanche"><?php echo $imprimante['REF_IMPRIMANTE']; ?></td>
							<td class="cell_tab_blanche"><?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?></td>
							<td class="cell_tab_blanche"><?php echo $imprimante['LIBELLE_MARQUE']; ?></td>
							<td class="cell_tab_blanche"><?php echo $imprimante['LIB_TYPE_IMPR']; ?></td>
							<td class="cell_tab_blanche"><?php echo $imprimante[4]; ?></td>
													
						</tr>
		
	
	
	<?php
				
						$blanc = false;
						
					}
					else
					{
			
	?>
	
						<tr>
							<td class="cell_tab_bleu"><?php echo $imprimante['REF_IMPRIMANTE']; ?></td>
							<td class="cell_tab_bleu"><?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?></td>
							<td class="cell_tab_bleu"><?php echo $imprimante['LIBELLE_MARQUE']; ?></td>
							<td class="cell_tab_bleu"><?php echo $imprimante['LIB_TYPE_IMPR']; ?></td>
							<td class="cell_tab_bleu"><?php echo $imprimante[4]; ?></td>
																		
						</tr>
	
	
	
	<?php
						$blanc = true;
				
					}
				
		
		
		
		
				}
				
			}
		
	?>
	
	
	</table>
	
	<?php
	
		}
	
	?>


</body>
</html>
