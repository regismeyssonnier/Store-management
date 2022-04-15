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
						CONFIGURATION - Marque d'imprimante
					</div>
					</center>
			
					<form action="marque.php" method="post" id="form_ajout_marque">
					<table class="tab_bleu_375">
						<tr>
							<td class="titre_fond_bleu25" valign="top" colspan="3">
								Ajouter une marque d'immprimante
							</td>
						</tr>
						<tr>
							<td class="cell_75_simple">Marque</td>
							<td class="cell_300_simple" colspan="2">
								<input type="text" name="marque" value="" size="50" maxlength="75" />
							</td>
						</tr>
						<tr>
							<td class="titre_fond_bleu25" colspan="3"><input type="button" name="ajout_marque" value="Ajouter nouvelle marque" class="bouton_blanc12" onclick="Ajouter_marque();"/></td>
						</tr>
					</table>	
					</form>
						
					<div id="zone_marque">
					<?php
						
						include('marque_ajax.php');
						
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