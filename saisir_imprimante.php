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
					IMPRIMANTE - Saisie imprimante
				</div>
				</center>
			
				<?php
				
					include('connect.php');
				
					$saisie = true;
					if(isset($_POST['enregistrer']))
					{
						$sql_impr = "INSERT INTO IMPRIMANTE VALUES('" .$_POST['reference'] ."', '" .$_POST['designation'] ."', " .$_POST['marque'] .", " .$_POST['type_impr'] .");";
						mysql_query($sql_impr)or die("Erreur insertion imprimante : " .$sql_impr);
						
						for($i = 0;$i < $_SESSION['index_tab_saisie_impr'];$i++)
						{
							$sql_impr_en_serv = "INSERT INTO IMPR_EN_SERVICE VALUES(NULL, '" .$_POST['reference'] ."', '" .$_SESSION['tab_article_saisie_impr'][$i] ."', " .$_SESSION['tab_annee_article_saisie_impr'][$i] .");";
							mysql_query($sql_impr_en_serv)or die("Erreur impr_en_service : " .$sql_impr_en_serv);
						
						
						}
						//Reinitialise les variable
						$_SESSION['index_tab_saisie_impr'] = 0;
						$_SESSION['tab_article_saisie_impr'] = array();
						$_SESSION['tab_annee_article_saisie_impr'] = array();
												
						$saisie = false;
					
					}
				
					if($saisie)
					{
				
				?>
			
						<form action="saisir_imprimante.php" method="post" id="form_ajout_impr" onsubmit="return Valider_form_ajout_impr();">
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
									
									echo '<select id="type_impr" name="type_impr" >';
									while($tpi = mysql_fetch_array($res_t))
									{
										echo '<option value="' .$tpi['ID_TYPE_IMPR'] .'">' .$tpi['LIB_TYPE_IMPR'] .'</option>';
									
									}
									echo '</select>';
									
								?>
								</span>
								<a onclick="Fenetre_type_impr('ajouter_type_impr.php');">ajouter un type imprimante</a>
								</td>
							</tr>
							<tr>
								<td>Marque</td>
								<td colspan="2">
								<span id="zone_marque_impr">
								<?php
								
									$sql_marque = "SELECT * FROM MARQUE;";
									$res_m = mysql_query($sql_marque);
									
									echo '<select id="marque" name="marque" >';
									while($marque = mysql_fetch_array($res_m))
									{
										echo '<option value="' .$marque['ID_MARQUE'] .'">' .$marque['LIBELLE_MARQUE'] .'</option>';
									
									}
									echo '</select>';
									
								?>
								</span>
								<a onclick="Fenetre_type_impr('ajouter_marque_impr.php');">ajouter une marque</a>
								</td>
							</tr>
							<tr>
								<td>R&eacute;f&eacute;rence</td>
								<td colspan="2"><input type="text" id="ref" name="reference" value="" maxlength="25" size="25" onblur=""/></td>
							</tr>
							<tr>
								<td>D&eacute;signation</td>
								<td colspan="2"><input type="text" name="designation" value="" maxlength="75" size="50"/></td>
							</tr>
							
							<tr>
								<td class="titre_fond_bleu25" colspan="3">Associer l'imprimante a un ou plusieurs service(s)</td>
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
								<td class="titre_fond_bleu25" colspan="3"><input type="button" name="associer" value="Associer" class="bouton_blanc12" onclick="Associer_impr_saisie();" /></td>
							</tr>
							<tr>
								<td id="zone_liste_impr" colspan="3">
								<?php
								
									include('associer_impr_saisie.php');
								
								?>
								</td>
							</tr>
							<tr>
								<td class="titre_fond_bleu25" colspan="3"><input type="submit" name="enregistrer" value="Enregistrer l'imprimante" class="bouton_blanc12"/></td>
							</tr>
						</table>	
						</form>
						
				<?php
				
					}
					else
					{
									
				?>
				
						<form action="saisir_imprimante.php" method="post">
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top">
									Ajouter une imprimante
								</td>
							</tr>
							<tr>
								<td>L'imprimante a bien &eacute;t&eacute; ajout&eacute;</td>
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