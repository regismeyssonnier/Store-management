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
					CONFIGURATION - Gestions des services
				</div>
				</center>
				
				<?php
				
					include('connect.php');
					
					$saisie = true;
					
					if(isset($_POST['ajout_service']))
					{
						$sql_ins = "INSERT INTO SERVICE VALUES('" .$_POST['id_service'] ."', '" .$_POST['division'] ."', '" .$_POST['nom_service'] ."');";
						mysql_query($sql_ins)or die($sql_ins);
							
						$saisie = false;
					}
				
					if($saisie)
					{
				
				?>
				
						
				
						<form action="ajouter_service.php" method="post" id="form_ajout_service" onsubmit="return Ajouter_service();">
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top" colspan="3">
									Ajouter un service
								</td>
							</tr>
							<tr>
								<td class="">Division</td>
								<td class="" colspan="2">
								<?php
						
									$sql_division = "SELECT * FROM DIVISION ORDER BY ID_DIVISION;";
									$res_d = mysql_query($sql_division);
									
									echo '<select name="division" id="division">';
									while($division = mysql_fetch_array($res_d))
									{
										echo '<option value="' .$division['ID_DIVISION'] .'">' .$division['ID_DIVISION'] .'</option>';								
									}
									echo '</select>';
								
								?>
								</td>
							</tr>
							<tr>
								<td class="">Abbréviation Service</td>
								<td class="" colspan="2">
									<input type="text" name="id_service" value="" size="25" maxlength="25" />
								</td>
							</tr>
							<tr>
								<td class="">Libellé service</td>
								<td class="" colspan="2">
									<input type="text" name="nom_service" value="" size="60" maxlength="100" />
								</td>
							</tr>
							<tr>
								<td class="titre_fond_bleu25" colspan="3"><input type="submit" name="ajout_service" value="Ajouter nouveau service" class="bouton_blanc12" /></td>
							</tr>
						</table>	
						</form>
						
				<?php
				
					}
					else
					{
					
				?>
										
						<form action="ajouter_service.php" method="post" id="form_ajout_division">
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top" colspan="3">
									Ajouter un service
								</td>
							</tr>
							<tr>
								<td align="center">Le service a bien été ajouté</td>
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