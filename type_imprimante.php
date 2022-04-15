<?php

	include('session.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Accueil</title>
<link rel="stylesheet" type="text/css" href="site.css"/>
<script src="site.js" type="text/javascript">
</script>
<script src="prototype.js" type="text/javascript">
</script>
</head>
<body>

	<table class="tab_principal">
		<tr>
			<td class="cell_entete" colspan="2"></td>
		</tr>	
		<tr>
			<td class="cell_gauche" valign="top">
			<?php
			
				include('menu.php');
			
			?>
			</td>
			<td class="cell_centre" valign="top">
			
				<?php
				
					include('connect.php');
				
					
				
				?>
				
					<center>
					<div class="titre_page">
						CONFIGURATION - Type d'imprimante
					</div>
					</center>
			
					<form action="tva.php" method="post" id="form_ajout_type_impr">
					<table class="tab_bleu_375">
						<tr>
							<td class="titre_fond_bleu25" valign="top" colspan="3">
								Ajouter un type d'imprimante
							</td>
						</tr>
						<tr>
							<td class="cell_75_simple">Type</td>
							<td class="cell_300_simple" colspan="2">
								<input type="text" name="type_impr" value="" size="50" maxlength="75" />
							</td>
						</tr>
						<tr>
							<td class="titre_fond_bleu25" colspan="3"><input type="button" name="ajout_type_impr" value="Ajouter nouveau type d'imprimante" class="bouton_blanc12" onclick="Ajouter_type_impr();"/></td>
						</tr>
					</table>	
					</form>
						
					<div id="zone_type_impr">
					<?php
						
						include('type_imprimante_ajax.php');
						
					?>
					</div>
				
				
			</td>
		</tr>
		<tr>
			<td class="cell_pied_page" colspan="2">
			</td>
		</tr>
	</table>









</body>
</html>