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
<script src="ajax.js" type="text/javascript">
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
					SUIVI DU STOCK - Fiche consommmable
				</div>
				</center>
			
				<?php
				
					include('connect.php');
				
					if(isset($_GET['num_conso']))
					{
						$sql_conso = "SELECT * FROM CONSOMMABLE WHERE REFERENCE = '" .$_GET['num_conso'] ."';";
						$res_c = mysql_query($sql_conso)or die($sql_conso);
						
						if(mysql_num_rows($res_c) > 0)
						{
							$conso = mysql_fetch_array($res_c);
							
									
				?>
							<div class="div_cont">
								<div class="div_ajax_suppr" id="ajax_suppr">
									<center>
										Suppression en cours
										<img src="Image/wait.gif" alt="attente de la suppression" />
									</center>
								</div>
								<!-- On cache une iframe sous le calque pour pas que les select transperce le calque -->
								<iframe src="javascript&#058;" 
									style="z-index:1;" 
									frameborder="0" 
									class="div_ajax_suppr" id="ajax_suppr_if"> 
								</iframe> 
								
								<div class="div_ajax_modif" id="ajax_modif">
									
								</div>
								
							</div>
							
							
							<form action="<?php	if(isset($_GET['redirection']))echo $_GET['redirection'];else echo "liste_conso.php"; ?>" method="post" id="form_aff_conso">
							<input type="hidden" name="etat_ref" id="et_ref" value="" />
							<input type="hidden" name="conso_ref" id="conso_ref" value="<?php echo $_GET['num_conso']; ?>"/>
							<input type="hidden" name="conso_des" id="conso_des" value="<?php echo $conso['DESIGNATION']; ?>"/>
							<input type="hidden" name="conso_prix_tot" id="conso_prix_tot" value="<?php echo $conso['PRIX_UNITAIRE'] * $conso['LOT']; ?>"/>
							<input type="hidden" name="conso_lot" id="conso_lot" value="<?php echo $conso['LOT']; ?>"/>
							<input type="hidden" name="conso_pu" id="conso_pu" value="<?php echo $conso['PRIX_UNITAIRE']; ?>"/>
							<input type="hidden" name="conso_qte_stock" id="conso_qte_stock" value="<?php echo $conso['QTE_STOCK']; ?>"/>
							<input type="hidden" name="conso_seuil_reap" id="conso_seuil_reap" value="<?php echo $conso['SEUIL_REAP']; ?>"/>
							<input type="hidden" name="conso_com1" id="conso_com1" value="<?php echo substr($conso['COMMENTAIRE'], 0, 50); ?>"/>
							<input type="hidden" name="conso_com2" id="conso_com2" value="<?php echo substr($conso['COMMENTAIRE'], 50, 50); ?>"/>
							<input type="hidden" name="conso_com3" id="conso_com3" value="<?php echo substr($conso['COMMENTAIRE'], 100, 50); ?>"/>
							<input type="hidden" name="conso_com4" id="conso_com4" value="<?php echo substr($conso['COMMENTAIRE'], 150, 50); ?>"/>
							<input type="hidden" name="conso_com5" id="conso_com5" value="<?php echo substr($conso['COMMENTAIRE'], 200, 50); ?>"/>
							<input type="hidden" name="conso_com6" id="conso_com6" value="<?php echo substr($conso['COMMENTAIRE'], 250, 50); ?>"/>
							
							<input type="hidden" name="redirection" id="redirection" value="<?php
																								if(isset($_GET['redirection']))
																									echo $_GET['redirection'];
																								else
																									echo "liste_conso.php";
																							?>" />
							
							<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso_ind('imprimer_conso_ind.php?ref_conso=<?php echo $_GET['num_conso']; ?>');">
									<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
							</div>
													
							
							<table class="tab_bleu_575">
								<tr>
									<td class="titre_fond_bleu25" valign="top" colspan="2">
										Fiche consommable
									</td>
								</tr>
								<tr>
									<td>Type</td>
									<td>
									<span id="zone_type_conso">
									<?php
									
										$sql_select = "SELECT * FROM TYPE_CONSO;";
										$res_t = mysql_query($sql_select);
										
										echo '<select name="type_conso" onchange="Modif_valider_type_conso();">';
										while($type_c = mysql_fetch_array($res_t))
										{
											if($type_c['ID_TYPE'] == $conso['ID_TYPE'])
											{
												echo '<option value="' .$type_c['ID_TYPE'] .'" selected="selected">' .$type_c['LIBELLE_TYPE'] .'</option>';
											}		
											else
											{
												echo '<option value="' .$type_c['ID_TYPE'] .'">' .$type_c['LIBELLE_TYPE'] .'</option>';
											}
											
										}
										echo '</select>';
										
									?>
									</span>
									<a onclick="Fenetre_type_conso('ajouter_type_conso.php?ref=<?php echo $conso['REFERENCE']; ?>');">ajouter un type conso</a>
									</td>
								</tr>
								<tr>
									<td>R&eacute;f&eacute;rence</td>
									<td><input type="text" id="ref" name="reference" value="<?php echo $conso['REFERENCE']; ?>" maxlength="25" size="25" onblur="Modif_valider_reference();"/></td>
								</tr>
								<tr>
									<td>D&eacute;signation</td>
									<td><input type="text" name="designation" value="<?php echo $conso['DESIGNATION']; ?>" maxlength="75" size="50" onblur="Modif_valider_designation();"/></td>
								</tr>
								<tr>
									<td>Prix Total</td>
									<td>
										<input type="text" name="prix_tot" id="prix_tot" value="<?php echo $conso['PRIX_UNITAIRE'] * $conso['LOT']; ?>" maxlength="10" size="10" onblur="Calcul_prix_unitaire_prix_tot_modif();"/>
										par lot de
										<select name="lot" id="lot" onchange="Calcul_prix_unitaire_modif();">
											<?php
											
												for($i = 1;$i <= 30;$i++)
												{
													if($i == $conso['LOT'])
														echo '<option value="' .$i .'" selected="selected">' .$i .'</option>';
													else
														echo '<option value="' .$i .'">' .$i .'</option>';
													
												}
											
											?>
										</select>
										
									</td>
								</tr>
								<tr>
									<td>Prix unitaire</td>
									<td id="c_pu">
										<?php echo round($conso['PRIX_UNITAIRE'], 2) ."&#8364;"; ?>
									</td>
									<input type="hidden" id="pu" name="pu" value="<?php echo $conso['PRIX_UNITAIRE']; ?>"/>
								</tr>
								<tr>
									<td>TVA</td>
									<td>
									<span id="zone_tva">
									<?php
									
										$sql_select = "SELECT * FROM TVA;";
										$res_t = mysql_query($sql_select);

										echo '<select name="tva" onchange="Modif_valider_tva();">';
										while($tva = mysql_fetch_array($res_t))
										{
											if($tva['CODE_TVA'] == $conso['CODE_TVA'])
											{
												echo '<option value="' .$tva['CODE_TVA'] .'" selected="selected">' .$tva['TAUX_TVA'] .'</option>';
											}
											else
											{
												echo '<option value="' .$tva['CODE_TVA'] .'">' .$tva['TAUX_TVA'] .'</option>';
											}
																		
										}
										echo '</select>';
									
									?>
									</span>
									<a onclick="Fenetre_tva('ajouter_tva.php?ref=<?php echo $conso['REFERENCE']; ?>');">ajouter une tva</a>
									</td>
								</tr>
								<tr>
									<td>Qte stock</td>
									<td>
										<input type="text" <?php if($conso['QTE_STOCK'] <= $conso['SEUIL_REAP'])echo 'class="rupture_stock"'; ?> name="qte_stock" id="qte_stock" value="<?php echo $conso['QTE_STOCK']; ?>" maxlength="10" size="10" onblur="Modif_valider_qte_stock();"/>
										<span id="rupt_stock">
											<?php 
												if($conso['QTE_STOCK'] <= $conso['SEUIL_REAP'])
													echo '<span class="rupture_stock">seuil de réapprovisionnement atteint</span>'; 
											?>
										</span>
									</td>
								</tr>	
								<tr>
									<td>Seuil r&eacute;apro</td>
									<td><input type="text" name="seuil_reap" value="<?php echo $conso['SEUIL_REAP']; ?>" maxlength="10" size="10" onblur="Modif_valider_seuil_reap();"/></td>
								</tr>
								
								<tr>
									<td valign="top">Commentaire</td>
									<td>
										<input type="text" name="com1" value="<?php echo substr($conso['COMMENTAIRE'], 0, 50); ?>" maxlength="50" size="50" onblur="Modif_valider_commentaire();"/><br/>
										<input type="text" name="com2" value="<?php echo substr($conso['COMMENTAIRE'], 50, 50); ?>" maxlength="50" size="50" onblur="Modif_valider_commentaire();"/><br/>
										<input type="text" name="com3" value="<?php echo substr($conso['COMMENTAIRE'], 100, 50); ?>" maxlength="50" size="50" onblur="Modif_valider_commentaire();"/><br/>
										<input type="text" name="com4" value="<?php echo substr($conso['COMMENTAIRE'], 150, 50); ?>" maxlength="50" size="50" onblur="Modif_valider_commentaire();"/><br/>
										<input type="text" name="com5" value="<?php echo substr($conso['COMMENTAIRE'], 200, 50); ?>" maxlength="50" size="50" onblur="Modif_valider_commentaire();"/><br/>
										<input type="text" name="com6" value="<?php echo substr($conso['COMMENTAIRE'], 250, 50); ?>" maxlength="50" size="50" onblur="Modif_valider_commentaire();"/><p></p>
									</td>
								</tr>
								<tr>
									<td class="titre_fond_bleu25" colspan="3">Associer le consommable a une ou plusieurs imprimante(s)</td>
								</tr>
								<tr>
									<td class="cell_lib_ed">Type</td>
									<td class="cell_text_ed" colspan="2">
									<?php
									
										$sql_tp_i = "SELECT * FROM TYPE_IMPRIMANTE;";
										$res_t = mysql_query($sql_tp_i);
										
										$id_type = '';
										$prem = true;
										echo '<select id="type_impr" name="type_impr_ass" onchange="Changer_select_conso_saisie();">';
										while($tpi = mysql_fetch_array($res_t))
										{
											if($prem)
											{
												$id_type = $tpi['ID_TYPE_IMPR'];
												$prem = false;
											}
											echo '<option value="' .$tpi['ID_TYPE_IMPR'] .'">' .$tpi['LIB_TYPE_IMPR'] .'</option>';
										
										}
										echo '</select>';
									
									?>
									</td>
									
								</tr>
								<tr >
									<td class="cell_lib_ed">Ref + Designation</td>
									<td class="cell_text_ed" align="left" id="zone_conso" colspan="2">
									<?php
									
										include('select_ref_des.php');
									
									?>
									</td>
									
								</tr>
								<tr>
									<td class="titre_fond_bleu25" colspan="3"><input type="button" name="associer" value="Associer" class="bouton_blanc12" onclick="Associer_conso_modif('<?php echo $_GET['num_conso']; ?>');" /></td>
								</tr>
								<tr>
									<td id="zone_liste_conso" colspan="3">
									<?php
									
										include('associer_conso_modif.php');
									
									?>
									</td>
								</tr>
								<tr>
									<td class="titre_fond_bleu25" colspan="2">
										<input type="button" name="supprimer" id="bout_suppr" value="Supprimer le consommable" class="bouton_blanc12" onclick="Supprimer_conso();"/>
										<input type="submit" name="retour" value="Retour" class="bouton_blanc12"/>	
									</td>
								</tr>
							</table>	
							</form>
							
							<form action="liste_conso.php?retour=retour" method="post" id="form_retour">
							</form>
							
						
							
				<?php
				
						}
						else
						{
							echo "<center>Aucun consommable ne possede cette reference.</center>";
						
						}
				
					}
					else
					{
						echo "<center>Aucun numero de consommable n'a ete fourni a la page.</center>";
					
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