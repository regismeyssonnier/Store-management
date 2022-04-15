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
			
				<center>
				<div class="titre_page">
					CONFIGURATION - Gestions des divisions
				</div>
				</center>
				
				<?php
				
					include('connect.php');
					
					$saisie = true;
					
					if(isset($_POST['ajout_division']))
					{
						$sql_ins = "INSERT INTO DIVISION VALUES('" .$_POST['id_division'] ."', '" .utf8_decode($_POST['nom_division']) ."');";
						mysql_query($sql_ins);
						
						$sql_ins = "INSERT INTO DIVISION_ARCHIVE VALUES('" .$_POST['id_division'] ."', '" .utf8_decode($_POST['nom_division']) ."', CURDATE(), '');";
						mysql_query($sql_ins);
							
						$saisie = false;
					}
				
					if($saisie)
					{
				
				?>
				
						
				
						<form action="ajouter_division.php" method="post" id="form_ajout_division" onsubmit="return Ajouter_division();">
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
								<td class="titre_fond_bleu25" colspan="3">
									<input type="submit" name="ajout_division" value="Ajouter nouvelle division" class="bouton_blanc12" />
								</td>
							</tr>
						</table>	
						</form>
						
				<?php
				
					}
					else
					{
					
				?>
										
						<form action="ajouter_division.php" method="post" id="form_ajout_division">
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top" colspan="3">
									Ajouter une division
								</td>
							</tr>
							<tr>
								<td align="center">La division a bien été ajoutée</td>
							</tr>
							<tr>
								<td class="titre_fond_bleu25" colspan="3">
									<input type="submit" name="retour" value="Retour" class="bouton_blanc12" />
								</td>
							</tr>
						</table>	
						</form>
				
				<?php
				
					}
										
				?>
					
				
			</td>
		</tr>
		<tr>
			<td class="cell_pied_page" colspan="2">
			</td>
		</tr>
	</table>









</body>
</html>