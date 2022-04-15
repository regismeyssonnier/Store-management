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
					CONFIGURATION - Saisie utilisateur
				</div>
				</center>
			
				<?php
				
					include('connect.php');
				
					$saisie = true;
					if(isset($_POST['enregistrer']))
					{
						$sql_insert_util = "INSERT INTO UTILISATEUR VALUES(NULL, '" .$_POST['nom'] ."', '" .$_POST['prenom'] ."', '" .$_POST['login'] ."', '" .$_POST['service'] ."', " .$_POST['tp_util'] .");";
						mysql_query($sql_insert_util)or die($sql_insert_util);
						
						$saisie = false;
					
					}
				
					if($saisie)
					{
				
				?>
			
						<form action="saisir_utilisateur.php" method="post" id="form_ajout_util" onsubmit="return Valider_form_ajout_util();">
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top" colspan="3">
									Ajouter un utilisateur
								</td>
							</tr>
							<tr>
								<td>Type utilisateur</td>
								<td colspan="2">
								<?php
								
									$sql_tutil = "SELECT * FROM TYPE_UTIL;";
									$res_tu = mysql_query($sql_tutil);
									
									echo '<select name="tp_util">';
									while($tutil = mysql_fetch_array($res_tu))
									{
										echo '<option value="' .$tutil['ID_TYPE_UTIL'] .'">' .$tutil['LIBELLE_TYPE_UTIL'] .'</option>';
									
									}
									echo '</select>';
									
								?>
								</td>
							</tr>
							<tr>
								<td>Service</td>
								<td colspan="2">
									<?php
									
										$sql_serv = "SELECT * FROM SERVICE;";
										$res_s = mysql_query($sql_serv);
										
										echo '<select name="service">';
										while($serv = mysql_fetch_array($res_s))
										{
											echo '<option value="' .$serv['ID_SERVICE'] .'">' .$serv['ID_SERVICE'] .'</option>';
										
										}
										echo '</select>';
										
									
									?>
								</td>
							</tr>
							<tr>
								<td>Nom</td>
								<td colspan="2"><input type="text" name="nom" value="" maxlength="50" size="50"/></td>
							</tr>
							<tr>
								<td>Prenom</td>
								<td colspan="2"><input type="text" name="prenom" value="" maxlength="50" size="50"/></td>
							</tr>
							<tr>
								<td>Login</td>
								<td colspan="2"><input type="text" name="login" value="" maxlength="50" size="50"/></td>
							</tr>
							<tr>
								<td class="titre_fond_bleu25" colspan="3"><input type="submit" name="enregistrer" value="Enregistrer le nouvel utilisateur" class="bouton_blanc12"/></td>
							</tr>
						</table>	
						</form>
						
				<?php
				
					}
					else
					{
									
				?>
				
						<form action="saisir_utilisateur.php" method="post" >
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top">
									Ajouter un utilisateur
								</td>
							</tr>
							<tr>
								<td>L'utilisateur a bien &eacute;t&eacute; ajout&eacute;</td>
							</tr>
							<tr>
								<td class="titre_fond_bleu25"><input type="submit" name="retour" value="Retour" class="bouton_bleu12"/></td>
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