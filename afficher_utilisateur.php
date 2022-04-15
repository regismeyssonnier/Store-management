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
<!--------------------------- EXT JS ------------------------------>
<link rel="stylesheet" type="text/css" href="Ext_JS/resources/css/ext-all.css" />
<script type="text/javascript" src="Ext_JS/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="Ext_JS/ext-all.js"></script>
<!--------------------------- FIN EXT JS ------------------------------>
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
					CONFIGURATION - Fiche utilisateur
				</div>
				</center>
			
				<?php
				
					include('connect.php');
				
					if(isset($_GET['num_util']))
					{
						if(ctype_digit($_GET['num_util']))
						{
						
							$sql_util = "SELECT * FROM UTILISATEUR WHERE ID_UTILISATEUR = " .$_GET['num_util'] .";";
							$res_u = mysql_query($sql_util);
							
							if(mysql_num_rows($res_u) > 0)
							{
								$utilisateur = mysql_fetch_array($res_u);
				
				?>
			
								<form action="liste_utilisateur.php" method="post" id="form_aff_util" >
								<input type="hidden" name="id_util" id="id_util" value="<?php echo $utilisateur['ID_UTILISATEUR']; ?>" />
								<input type="hidden" name="nomh" id="nomh" value="<?php echo $utilisateur['NOM_UTILISATEUR']; ?>" />
								<input type="hidden" name="prenomh" id="prenomh" value="<?php echo $utilisateur['PRENOM_UTILISATEUR']; ?>" />
								<input type="hidden" name="loginh" id="loginh" value="<?php echo $utilisateur['LOGIN_UTILISATEUR']; ?>" />
																
								<table class="tab_bleu_575">
									<tr>
										<td class="titre_fond_bleu25" valign="top" colspan="3">
											Fiche utilisateur
										</td>
									</tr>
									<tr>
										<td>Type utilisateur</td>
										<td colspan="2">
										<?php
										
											$sql_tutil = "SELECT * FROM TYPE_UTIL;";
											$res_tu = mysql_query($sql_tutil);
											$i = 0;$j = 0;
											echo '<select name="tp_util" onchange="Modif_type_util();">';
											while($tutil = mysql_fetch_array($res_tu))
											{
												if($utilisateur['ID_TYPE_UTIL'] == $tutil['ID_TYPE_UTIL'])
												{
													echo '<option value="' .$tutil['ID_TYPE_UTIL'] .'" selected="selected">' .$tutil['LIBELLE_TYPE_UTIL'] .'</option>';
													$j = $i;	
												}
												else
													echo '<option value="' .$tutil['ID_TYPE_UTIL'] .'">' .$tutil['LIBELLE_TYPE_UTIL'] .'</option>';
											
												$i++;
											}
											echo '</select>';
											
										?>
										<input type="hidden" name="tp_utilh" id="tp_utilh" value="<?php echo $j; ?>" />
										</td>
									</tr>
									<tr>
										<td>Service</td>
										<td colspan="2">
											<?php
											
												$sql_serv = "SELECT * FROM SERVICE;";
												$res_s = mysql_query($sql_serv);
												$i = 0;$j = 0;
												echo '<select name="service" onchange="Modif_service_util();">';
												while($serv = mysql_fetch_array($res_s))
												{
													if($utilisateur['ID_SERVICE'] == $serv['ID_SERVICE'])
													{
														echo '<option value="' .$serv['ID_SERVICE'] .'" selected="selected">' .$serv['ID_SERVICE'] .'</option>';
														$j = $i;	
													}
													else
														echo '<option value="' .$serv['ID_SERVICE'] .'">' .$serv['ID_SERVICE'] .'</option>';
												
												}
												echo '</select>';
												
											
											?>
										<input type="hidden" name="serviceh" id="serviceh" value="<?php echo $j; ?>" />
										</td>
									</tr>
									<tr>
										<td>Nom</td>
										<td colspan="2"><input type="text" name="nom" value="<?php echo $utilisateur['NOM_UTILISATEUR']; ?>" maxlength="50" size="50" onblur="Modif_nom_util();"/></td>
									</tr>
									<tr>
										<td>Prenom</td>
										<td colspan="2"><input type="text" name="prenom" value="<?php echo $utilisateur['PRENOM_UTILISATEUR']; ?>" maxlength="50" size="50" onblur="Modif_prenom_util();"/></td>
									</tr>
									<tr>
										<td>Login</td>
										<td colspan="2"><input type="text" name="login" value="<?php echo $utilisateur['LOGIN_UTILISATEUR']; ?>" maxlength="50" size="50" onblur="Modif_login_util();"/></td>
									</tr>
									<tr>
										<td class="titre_fond_bleu25" colspan="3">
											<input type="button" name="supprimer" value="Supprimer l'utilisateur" class="bouton_blanc12" onclick="Supprimer_utilisateur();"/>
											<input type="submit" name="retour" value="retour" class="bouton_blanc12"/>
										</td>
									</tr>
								</table>	
								</form>
								
								<form action="liste_utilisateur.php?retour=retour" method="post" id="form_retour">
								</form>
							
							
						
				<?php
							}
							else
							{
								echo "<center>Aucun utilisateur ne possede ce numero.</center>";
							}
				
						}
						else
						{
							echo "<center>Mauvais numero d'utilisateur.</center>";
						}
				
					}
					else
					{
						echo "<center>Aucun numero d'utilisateur n'a ete fourni a la page.</center>";
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