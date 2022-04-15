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
				<td align="center" colspan="4" class="titre_fond_bleu25">
					Liste des imprimantes 
					
				</td>
			</tr>
			<tr>
				<td class="cell_ref_tab_impr">R&eacute;f&eacute;rence</td>
				<td class="cell_des_tab_impr">D&eacute;signation</td>
				<td class="cell_marque_tab_impr">Marque</td>
				<td class="cell_type_tab_impr">Type</td>
				
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
