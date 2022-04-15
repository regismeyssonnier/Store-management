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
	
		if( isset($_GET['sql_conso']) )
		{
	
	?>

			<table class="tab_conso">
			<tr>
				<td align="center" colspan="4" class="titre_fond_bleu25">
					Liste des Consommables
				</td>
			</tr>
			<tr>
				<td class="cell_ref_tab_conso">R&eacute;f&eacute;rence</td>
				<td class="cell_des_tab_conso">D&eacute;signation</td>
				<td class="cell_type_tab_conso">Type</td>
				<td class="cell_prix_tab_conso">Prix unitaire</td>
				
			</tr>
		
	<?php
	
			$res_conso = mysql_query($_GET['sql_conso']);
				
			$blanc = true;
			
			while($conso = mysql_fetch_array($res_conso))
			{
				$sql_type_conso = "SELECT * 
								   FROM TYPE_CONSO, CONSOMMABLE 
								   WHERE TYPE_CONSO.ID_TYPE = CONSOMMABLE.ID_TYPE
								   AND REFERENCE = '" .$conso['REFERENCE'] ."';";
				$res_t = mysql_query($sql_type_conso);
				$type_c = mysql_fetch_array($res_t);
																					
													
				if($blanc)
				{
			
	?>
					<tr>
						<td class="cell_tab_blanche"><?php echo $conso['REFERENCE']; ?></td>
						<td class="cell_tab_blanche"><?php echo $conso['DESIGNATION']; ?></td>
						<td class="cell_tab_blanche"><?php echo $type_c['LIBELLE_TYPE']; ?></td>
						<td class="cell_tab_blanche"><?php echo $conso['PRIX_UNITAIRE']; ?></td>
						
						
						
							
					</tr>
		
	
	
	<?php
				
					$blanc = false;
					
				}
				else
				{
			
	?>
	
					<tr>
						<td class="cell_tab_bleu"><?php echo $conso['REFERENCE']; ?></td>
						<td class="cell_tab_bleu"><?php echo $conso['DESIGNATION']; ?></td>
						<td class="cell_tab_bleu"><?php echo $type_c['LIBELLE_TYPE']; ?></td>
						<td class="cell_tab_bleu"><?php echo $conso['PRIX_UNITAIRE']; ?></td>
																		
					</tr>
	
	
	
	<?php
					$blanc = true;
			
			}
			
	
	
		
		
		}
		
	?>
	
	
	</table>
	
	<?php
	
		}
	
	?>


</body>
</html>
