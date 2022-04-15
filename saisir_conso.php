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
					CONFIGURATION - Saisie référence
				</div>
				</center>
			
				<?php
				
					include('connect.php');
				
					$saisie = true;
					if(isset($_POST['enregistrer']))
					{
						$sql_insert_conso = "INSERT INTO CONSOMMABLE VALUES('" .$_POST['reference'] ."', '" .addslashes($_POST['designation']) ."', " .$_POST['pu'] .", " .$_POST['lot'] .", " .$_POST['qte_stock'] .", " .$_POST['seuil_reap'] .", '" .addslashes($_POST['com1'].$_POST['com2'].$_POST['com3'].$_POST['com4'].$_POST['com5'].$_POST['com6']) ."', " .$_POST['tva'] .", " .$_POST['type_conso'] .");";
						mysql_query($sql_insert_conso)or die($sql_insert_conso);
						
						for($i = 0;$i < $_SESSION['index_tab_saisie'];$i++)
						{
							$sql_ins_ass = "INSERT INTO ASSOCIER VALUES('" .$_POST['reference'] ."', '" .$_SESSION['tab_article_saisie'][$i] ."');";
							mysql_query($sql_ins_ass)or die($sql_ins_ass);
						
						}
						
						//Reinitialise les variable
						$_SESSION['index_tab_saisie'] = 0;
						$_SESSION['tab_article_saisie'] = array();
						
						$saisie = false;
					
					}
				
					if($saisie)
					{
				
				?>
			
						<form action="saisir_conso.php" method="post" id="form_ajout_conso" onsubmit="return Valider_form_ajout_conso();">
						<input type="hidden" name="etat_ref" id="et_ref" value="" />
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top" colspan="3">
									Ajouter un consommable
								</td>
							</tr>
							<tr>
								<td>Type consommable</td>
								<td colspan="2">
								<span id="zone_type_conso">
								<?php
								
									include('select_type_conso.php');
									
								?>
								</span>
								<a onclick="Fenetre_type_conso('ajouter_type_conso.php');">ajouter un type conso</a>
								</td>
							</tr>
							<tr>
								<td>R&eacute;f&eacute;rence</td>
								<td colspan="2"><input type="text" id="ref" name="reference" value="" maxlength="25" size="25" /></td>
							</tr>
							<tr>
								<td>D&eacute;signation</td>
								<td colspan="2"><input type="text" name="designation" value="" maxlength="75" size="50"/></td>
							</tr>
							<tr>
								<td>Prix Total</td>
								<td colspan="2">
									<input type="text" name="prix_tot" id="prix_tot" value="" maxlength="10" size="10" onblur="Calcul_prix_unitaire_prix_tot();"/>
									par lot de
									<select name="lot" id="lot" onchange="Calcul_prix_unitaire();">
										<?php
										
											for($i = 1;$i <= 30;$i++)
												echo '<option value="' .$i .'">' .$i .'</option>';
										
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Prix unitaire</td>
								<td colspan="2" id="c_pu">
								
								</td>
								<input type="hidden" id="pu" name="pu" value=""/>
							</tr>
							<tr>
								<td>TVA</td>
								<td colspan="2">
								<span id="zone_tva">
								<?php
								
									include('select_tva.php');
								
								?>
								</span>
								<a onclick="Fenetre_tva('ajouter_tva.php');">ajouter une tva</a>
								</td>
							</tr>
							<tr>
								<td>Qte stock</td>
								<td colspan="2"><input type="text" name="qte_stock" value="" maxlength="10" size="10"/></td>
							</tr>	
							<tr>
								<td>Seuil r&eacute;apro</td>
								<td colspan="2"><input type="text" name="seuil_reap" value="" maxlength="10" size="10"/></td>
							</tr>
							
							<tr>
								<td valign="top">Commentaire</td>
								<td colspan="2">
									<input type="text" name="com1" value="" maxlength="50" size="50"/><br/>
									<input type="text" name="com2" value="" maxlength="50" size="50"/><br/>
									<input type="text" name="com3" value="" maxlength="50" size="50"/><br/>
									<input type="text" name="com4" value="" maxlength="50" size="50"/><br/>
									<input type="text" name="com5" value="" maxlength="50" size="50"/><br/>
									<input type="text" name="com6" value="" maxlength="50" size="50"/><p></p>
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
								<td class="titre_fond_bleu25" colspan="3"><input type="button" name="associer" value="Associer" class="bouton_blanc12" onclick="Associer_conso_saisie();" /></td>
							</tr>
							<tr>
								<td id="zone_liste_conso" colspan="3">
								<?php
								
									include('associer_conso_saisie.php');
								
								?>
								</td>
							</tr>
							<tr>
								<td class="titre_fond_bleu25" colspan="3"><input type="submit" name="enregistrer" value="Enregistrer le consommable" class="bouton_blanc12"/></td>
							</tr>
						</table>	
						</form>
						
				<?php
				
					}
					else
					{
									
				?>
				
						<form action="saisir_conso.php" method="post" id="form_ajout_conso">
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top">
									Ajouter un consommable
								</td>
							</tr>
							<tr>
								<td>Le consommable a bien &eacute;t&eacute; ajout&eacute;</td>
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