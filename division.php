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
				
					<div class="titre_page">
						Gestions des divisions
					</div>
			
					<form action="division.php" method="post" id="form_ajout_division">
					<table class="tab_bleu_575">
						<tr>
							<td class="titre_fond_bleu25" valign="top" colspan="3">
								Ajouter une division
							</td>
						</tr>
						<tr>
							<td class="">Abbréviation Division</td>
							<td class="" colspan="2">
								<input type="text" name="id_division" value="" size="25" maxlength="25" />
							</td>
						</tr>
						<tr>
							<td class="">Libellé Division</td>
							<td class="" colspan="2">
								<input type="text" name="nom_division" value="" size="60" maxlength="100" />
							</td>
						</tr>
						<tr>
							<td class="titre_fond_bleu25" colspan="3"><input type="button" name="ajout_division" value="Ajouter nouvelle division" class="bouton_blanc12" onclick="Ajouter_division();"/></td>
						</tr>
					</table>	
					</form>
					
					<form action="division.php" method="post" id="form_fusionner_division">
					<table class="tab_bleu_575">
						<tr>
							<td class="titre_fond_bleu25" valign="top" colspan="3">
								Fusionner 2 divisions
							</td>
						</tr>
						<tr>
							<td colspan="3" style="text-align:justify;">
								&nbsp;&nbsp;&nbsp;&nbsp;Pour fusionner 2 divisions, choisir tout d'abord les deux division à fusionner
								(Division1 et Division2), puis choisir la nouvelle division apres l'avoir ajouter(Fusionne en), puis
								cliquer sur Fusionner 2 divisions.
							</td>
						</tr>
						<tr>
							<td class="cell_75_simple">Division 1</td>
							<td class="cell_500_simple" colspan="2" id="zone_div1">
							<?php
					
								include('select_division1.php');
							
							?>
							</td>
						</tr>
						<tr>
							<td class="cell_75_simple">Division 2 </td>
							<td class="cell_500_simple" colspan="2" id="zone_div2">
							<?php
					
								include('select_division2.php');
							
							?>
							</td>
						</tr>
						<tr>
							<td class="cell_75_simple">Fusionne en</td>
							<td class="cell_500_simple" colspan="2" id="zone_div3">
							<?php
					
								include('select_division3.php');
							
							?>
							</td>
						</tr>
						<tr>
							<td class="titre_fond_bleu25" colspan="3"><input type="button" name="fusionner_division" value="Fusionner 2 division" class="bouton_blanc12" onclick="Fusionner_division();"/></td>
						</tr>
					</table>	
					</form>
						
					<div id="zone_division">
					<?php
						
						include('division_ajax.php');
						
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