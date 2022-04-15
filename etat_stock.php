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
					SUIVI DU STOCK - Etat des stocks
				</div>
				</center>
			
			
				<fieldset class="field_rech">
					<legend class="legend_rech">Rechercher par:</legend>
					<table class="tab_rechercher">
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Type du consommable
							</td>
						</tr>
						<form action="etat_stock.php" method="post">
						<tr>
							<td>Type :</td>
							<td>
							<?php
							
								$sql_select = "SELECT * FROM TYPE_CONSO;";
								$res_t = mysql_query($sql_select);
								
								echo '<select name="type_conso">';
								while($type_c = mysql_fetch_array($res_t))
								{
									echo '<option value="' .$type_c['ID_TYPE'] .'">' .$type_c['LIBELLE_TYPE'] .'</option>';
																
								}
								echo '</select>';
							
							?>
							</td>
							<td align="right">
								<input type="submit" name="rech_type_conso" value="Rechercher"/>
							</td>
						</tr>
						</form>
						
					</table>
				</fieldset>
				
				<?php
				
					$page = 1;
					//Affiche 30 consommables par page
					$conso_par_page = 5;
					//type de recherche
					$rech = '';
					
					//pour recherche par type
					$type_conso = '';
					//pour recherche par prix					
					$prix = '';
					$op_prix = '';
					//pour recherche compris entre
					$prix1 = '';
					$prix2 = '';
					//pour recherche date livraison
					$date1 = '';
					$date2 = '';
					
					//requete sql
					$sql_conso = "SELECT * FROM CONSOMMABLE ";
					
					
					
					if(isset($_GET['page']))
					{
						if(ctype_digit($_GET['page']))
						{
							if($_GET['page'] < 1)
								$page = 1;
							else
								$page = $_GET['page'];
						}
						else
						{
							$page = 1;
						}
						
					}
					
					if(isset($_POST['rech_type_conso']))
					{
						$sql_conso .= ", TYPE_CONSO
									   WHERE TYPE_CONSO.ID_TYPE = CONSOMMABLE.ID_TYPE
									   AND CONSOMMABLE.ID_TYPE = " .$_POST['type_conso'] ." ";
									   
						$rech = 'type_conso';
						$type_conso = $_POST['type_conso'];
												
					
					}
					else if(isset($_GET['type_conso']))
					{
						$sql_conso .= ", TYPE_CONSO
									   WHERE TYPE_CONSO.ID_TYPE = CONSOMMABLE.ID_TYPE
									   AND CONSOMMABLE.ID_TYPE = " .$_GET['type_conso'] ." ";
									   
						$rech = 'type_conso';
						$type_conso = $_GET['type_conso'];
											
					}
					
					
					
					if($res_c = mysql_query($sql_conso))
					{
						$nb_conso = mysql_num_rows($res_c);
						$max_page = $nb_conso / $conso_par_page;
						if(($max_page > 0) && ($max_page < 1))$max_page = 1;
						else $max_page = ceil($max_page);
						
						if($page > $max_page)
							$page = $max_page;
						
						$index = ($page - 1) * $conso_par_page;
						
						$sql_conso .= "LIMIT $index, $conso_par_page";
						
													
						if($nb_conso != 0)
						{
							
							if($res_conso = mysql_query($sql_conso))
							{
							
								$ch_page = "";
								$ch_psuiv = "";
								$ch_pprec = "";
						
					
				?>
				
								<table class="tab_conso">
						
									<tr>
										<td align="center" colspan="3" class="titre_fond_bleu25">
											Liste des Consommables
										</td>
									</tr>
									
									<tr>
										<td align="center" colspan="3" class="cell_page">
										
											<table class="tab_page">
												<tr>
													<td class="cell_pied_tabc">
														
														<?php
														
															$pp = $page - 1;
															$ch_pprec = '<a href="etat_stock.php?page=' .$pp;  
															
															if($rech == 'type_conso')
															{
																$ch_pprec .= "&type_conso=" .$type_conso;
															}
															else if($rech == 'prix')
															{
																$ch_pprec .= "&prix=" .$prix;	
																$ch_pprec .= "&op_prix=" .$op_prix;																
															}
															else if($rech == 'prix_compris')
															{
																$ch_pprec .= "&prix1=" .$prix1;	
																$ch_pprec .= "&prix2=" .$prix2;
															}
															else if($rech == 'date')
															{
																$ch_pprec .= "&date1=" .$date1;	
																$ch_pprec .= "&date2=" .$date2;
															}
															
															$ch_pprec .= '" class="lien_blanc"><< page prec</a>';
														
															if($page > 1)						
																echo $ch_pprec;
														
														?>
													
													</td>
													<td colspan="2" class="cell_pied_tabm">
													
														<?php
														
															$ch_page = '<div class="div_blanc">page ';
																								
															$i = $page - 5;
															if($page <= 5)
																$i = 1;
																
															$max = $page + 5;
															if($max > $max_page)
																$max = $max_page;
															
															
															while($i <= $max)
															{
																if($i == $page)
																	$ch_page .= '<span class="lien_rouge">' .$i .'</span>';
																else
																{
																	$ch_page .= '<a href="etat_stock.php?page=' .$i;
																	
																	if($rech == 'type_conso')
																	{
																		$ch_page .= "&type_conso=" .$type_conso;
																	}
																	else if($rech == 'prix')
																	{
																		$ch_page .= "&prix=" .$prix;	
																		$ch_page .= "&op_prix=" .$op_prix;																
																	}
																	else if($rech == 'prix_compris')
																	{
																		$ch_page .= "&prix1=" .$prix1;	
																		$ch_page .= "&prix2=" .$prix2;
																	}
																	else if($rech == 'date')
																	{
																		$ch_page .= "&date1=" .$date1;	
																		$ch_page .= "&date2=" .$date2;
																	}
																														
																	$ch_page .= '" class="lien_blanc">' .$i .'</a>';
																	 
																}
																	
																if($i < $max)
																	$ch_page .= " - ";
																	
																$i++;
															
															}	
														
															$ch_page .= "/ $max_page</div>";
															
															echo $ch_page;
																								
														?>
														
													</td>
													<td class="cell_pied_tabc">
													
														<?php
														
															$ps = $page + 1;
															$ch_psuiv = '<a href="etat_stock.php?page=' .$ps;
															
															if($rech == 'type_conso')
															{
																$ch_psuiv .= "&type_conso=" .$type_conso;
															}
															else if($rech == 'prix')
															{
																$ch_psuiv .= "&prix=" .$prix;	
																$ch_psuiv .= "&op_prix=" .$op_prix;																
															}
															else if($rech == 'prix_compris')
															{
																$ch_psuiv .= "&prix1=" .$prix1;	
																$ch_psuiv .= "&prix2=" .$prix2;
															}
															else if($rech == 'date')
															{
																$ch_psuiv .= "&date1=" .$date1;	
																$ch_psuiv .= "&date2=" .$date2;
															}
													
															$ch_psuiv .= '" class="lien_blanc">page suiv >></a>';
														
															if($page < $max_page)						
																echo $ch_psuiv;
														
														?>
														
														
													</td>
												</tr>
											</table>
											
										</td>
									</tr>	
									
									<tr>
										<td class="cell_ref_tab_etat_stock">R&eacute;f&eacute;rence</td>
										<td class="cell_des_tab_etat_stock">D&eacute;signation</td>
										<td class="cell_qte_stock_tab_etat_stock">Stock</td>
																				
									</tr>
									
									
				<?php
								
								$blanc = true;
								
								while($conso = mysql_fetch_array($res_conso))
								{
																							
									if($blanc)
									{
									
				?>
										<tr>
											<td class="cell_tab_blanche"><?php echo $conso['REFERENCE']; ?></td>
											<td class="cell_tab_blanche"><?php echo $conso['DESIGNATION']; ?></td>
											<td class="cell_tab_blanche"><?php echo $conso['QTE_STOCK']; ?></td>
																	
										</tr>
								
				
				
				<?php
										
										$blanc = false;
										
									}
									else
									{
									
				?>
				
										<tr>
											<td class="cell_tab_bleu"><?php echo $conso['REFERENCE']; ?></td>
											<td class="cell_tab_bleu"><?php echo $conso['DESIGNATION']; ?></td>
											<td class="cell_tab_bleu"><?php echo $conso['QTE_STOCK']; ?></td>
																							
										</tr>
				
						
				
				<?php
										$blanc = true;
									
									}
									
			
						
								
								
								}
								
				?>
									<tr>
										<td class="titre_fond_bleu25" colspan="3">
										
											<table class="tab_page">
												<tr>
													<td class="cell_pied_tabc">
													
														<?php
														
															if($page > 1)						
																echo $ch_pprec;
														
														?>
													
													</td>
													<td colspan="2" class="cell_pied_tabm">
														<?php
														
															echo $ch_page;
														
														?>
													</td>
													<td class="cell_pied_tabc">
														
														<?php
														
															if($page < $max_page)						
																	echo $ch_psuiv;
																	
														?>
														
													</td>
												</tr>
											</table>
											
											
										</td>
									</tr>
									
								
								</table>
								
								<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso('imprimer_etat_stock.php?sql_conso=<?php echo str_replace("
								", " ", $sql_conso); ?>');">
									<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
								</div>
				
				<?php
							
							
							
							
							}
						
						
						
						
						}
						else
						{
							echo '<div class="texte_350_centre">Aucun resultat ne correspond a votre recherche.</div>';
						
						}
					
					
					}
					else
					{
						echo '<center>' .mysql_error() .'</center>';
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