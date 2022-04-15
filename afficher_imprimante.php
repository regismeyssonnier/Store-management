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
			
				<?php
				
					include('connect.php');
				
					$saisie = true;
					
					if(isset($_GET['ref_impr']))
					{
						$sql_impr = "SELECT * FROM IMPRIMANTE WHERE REF_IMPRIMANTE = '" .$_GET['ref_impr'] ."';";
						$res_i = mysql_query($sql_impr)or die("Erreur imprimante : " .$sql_impr);
						
						if(mysql_num_rows($res_i) > 0)
						{
							$imprimante = mysql_fetch_array($res_i);
							
				
				?>
							<div class="div_cont">
								<div class="div_ajax_suppr_impr" id="ajax_suppr_impr">
									<center>
										Suppression en cours
										<img src="Image/wait.gif" alt="attente de la suppression" />
									</center>
								</div>
								<!-- On cache une iframe sous le calque pour pas que les select transperce le calque -->
								<iframe src="javascript&#058;" 
									style="z-index:1;" 
									frameborder="0" 
									class="div_ajax_suppr_impr" id="ajax_suppr_impr_if"> 
								</iframe> 
														
								
							</div>
				
			
							<form action="liste_imprimante.php" method="post" id="form_modif_impr" >
							<input type="hidden" name="hid_ref" id="hid_ref" value="<?php echo $imprimante['REF_IMPRIMANTE']; ?>" />
							<input type="hidden" name="hid_des" id="hid_des" value="<?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?>" />
							
							<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso_ind('imprimer_imprimante.php?ref_impr=<?php echo $_GET['ref_impr']; ?>');">
									<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
							</div>
							
							
							<table class="tab_bleu_575">
								<tr>
									<td class="titre_fond_bleu25" valign="top" colspan="3">
										Ajouter une imprimante
									</td>
								</tr>
								<tr>
									<td>Type imprimante</td>
									<td colspan="2">
									<span id="zone_type_impr">
									<?php
									
										$sql_tp_i = "SELECT * FROM TYPE_IMPRIMANTE;";
										$res_t = mysql_query($sql_tp_i);
										$i = 0;$j = 0;
										echo '<select id="type_impr" name="type_impr" onchange="Valider_type_imprimante();">';
										while($tpi = mysql_fetch_array($res_t))
										{
											if($imprimante['ID_TYPE_IMPR'] == $tpi['ID_TYPE_IMPR'])
											{
												echo '<option value="' .$tpi['ID_TYPE_IMPR'] .'" selected="selected">' .$tpi['LIB_TYPE_IMPR'] .'</option>';
												$j = $i;
											}
											else
												echo '<option value="' .$tpi['ID_TYPE_IMPR'] .'">' .$tpi['LIB_TYPE_IMPR'] .'</option>';
										
											$i++;
										}
										echo '</select>';
										
									?>
									</span>
									<a onclick="Fenetre_type_impr('ajouter_type_impr.php?modif=modif');">ajouter un type imprimante</a>
									<input type="hidden" name="hid_type_impr" id="hid_type_impr" value="<?php echo $j; ?>" />
									</td>
								</tr>
								<tr>
									<td>Marque</td>
									<td colspan="2">
									<span id="zone_marque_impr">
									<?php
									
										$sql_marque = "SELECT * FROM MARQUE;";
										$res_m = mysql_query($sql_marque);
										$i = 0;$j = 0;
										echo '<select id="marque" name="marque" onchange="Valider_marque_imprimante();">';
										while($marque = mysql_fetch_array($res_m))
										{
											if($imprimante['ID_MARQUE'] == $marque['ID_MARQUE'])
											{
												echo '<option value="' .$marque['ID_MARQUE'] .'" selected="selected">' .$marque['LIBELLE_MARQUE'] .'</option>';
												$j = $i;
											}
											else
												echo '<option value="' .$marque['ID_MARQUE'] .'">' .$marque['LIBELLE_MARQUE'] .'</option>';
										
											$i++;
										}
										echo '</select>';
										
									?>
									</span>
									<a onclick="Fenetre_type_impr('ajouter_marque_impr.php?modif=modif');">ajouter une marque</a>
									<input type="hidden" name="hid_marque" id="hid_marque" value="<?php echo $j; ?>" />
									</td>
								</tr>
								<tr>
									<td>R&eacute;f&eacute;rence</td>
									<td colspan="2"><input type="text" id="ref" name="reference" value="<?php echo $imprimante['REF_IMPRIMANTE']; ?>" maxlength="25" size="25" onblur="Valider_reference_imprimante();"/></td>
								</tr>
								<tr>
									<td>D&eacute;signation</td>
									<td colspan="2"><input type="text" name="designation" value="<?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?>" maxlength="75" size="50" onblur="Valider_designation_imprimante();"/></td>
								</tr>
								
								<tr>
									<td class="titre_fond_bleu25" colspan="3">Associer l'imprimante aux services</td>
								</tr>
								<tr>
									<td class="cell_lib_ed">Division</td>
									<td class="cell_text_ed" colspan="2">
									<?php
									
										$sql_division = "SELECT * FROM DIVISION;";
										$res_d = mysql_query($sql_division);
										
										$prem = true;
										$id_division = '';
										echo '<select name="division" id="division" onchange="Changer_select_service();">';
										while($division = mysql_fetch_array($res_d))
										{
											if($prem)
											{
												$id_division = $division['ID_DIVISION'];
												$prem = false;
											}
											echo '<option value="' .$division['ID_DIVISION'] .'">' .$division['NOM_DIVISION'] .'</option>';								
										}
										echo '</select>';
									
									?>
									</td>
									
								</tr>
								<tr >
									<td class="cell_lib_ed">Service</td>
									<td class="cell_text_ed" align="left" id="zone_sel_service" colspan="2">
									<?php
									
										include('select_service.php');
									
									?>
									</td>
									
								</tr>
								<tr>
									<td class="titre_fond_bleu25" colspan="3"><input type="button" name="associer" value="Associer" class="bouton_blanc12" onclick="Associer_impr_modif();" /></td>
								</tr>
								<tr>
									<td id="zone_liste_impr" colspan="3">
									<?php
									
										include('associer_impr_modif.php');
									
									?>
									</td>
								</tr>
								<tr>
									<td class="titre_fond_bleu25" colspan="3">
										<input type="button" name="supprimer" id="suppr_bout" value="Supprimer l'imprimante" class="bouton_blanc12" onclick="Supprimer_imprimante();"/>
										<input type="submit" name="retour" value="Retour" class="bouton_blanc12" />
										
									</td>
								</tr>
							</table>	
							</form>
							
							<form action="liste_imprimante.php?retour=retour" method="post" id="form_retour">
							</form>
					
				<?php
						}
						else
						{
							echo "<center>Aucune imprimante n'a cette reference</center>";
						}
				
				
					}
					else
					{
					
						echo "<center>Aucune reference d'imprimante n'a ete fourni a la page</center>";
					
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