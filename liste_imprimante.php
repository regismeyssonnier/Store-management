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
			
				<?php
				
					include('connect.php');
				
				?>
				
				<center>
				<div class="titre_page">
					IMPRIMANTE - Liste des imprimantes
				</div>
				</center>
			
				<fieldset class="field_rech">
					<legend class="legend_rech">Rechercher par:</legend>
					<table class="tab_rechercher">
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Type d'imprimante
							</td>
						</tr>
						<form action="liste_imprimante.php" method="post">
						<tr>
							<td>Type :</td>
							<td>
							<?php
							
								$sql_select = "SELECT * FROM TYPE_IMPRIMANTE;";
								$res_t = mysql_query($sql_select);
								
								echo '<select id="type_impr" name="type_impr">';
								while($type_i = mysql_fetch_array($res_t))
								{
									echo '<option value="' .$type_i['ID_TYPE_IMPR'] .'">' .$type_i['LIB_TYPE_IMPR'] .'</option>';
																
								}
								echo '</select>';
							
							?>
							</td>
							<td align="right">
								<input type="submit" name="rech_type_impr" value="Rechercher"/>
							</td>
						</tr>
						</form>
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Marque
							</td>
						</tr>
						<form action="liste_imprimante.php" method="post">
						<tr>
							<td>Marque :</td>
							<td>
							<?php
							
								$sql_select = "SELECT * FROM MARQUE;";
								$res_m = mysql_query($sql_select);
								
								echo '<select id="marque" name="marque">';
								while($marque = mysql_fetch_array($res_m))
								{
									echo '<option value="' .$marque['ID_MARQUE'] .'">' .$marque['LIBELLE_MARQUE'] .'</option>';
																
								}
								echo '</select>';
							
							?>
							</td>
							<td align="right">
								<input type="submit" name="rech_marque_impr" value="Rechercher"/>
							</td>
						</tr>
						</form>
						
					</table>
				</fieldset>
				
				<?php
				
					$page = 1;
					//Affiche 30 imprimantes par page
					$impr_par_page = 2;
					//type de recherche
					$rech = '';
					
					//pour recherche par type
					$type_impr = '';
					//pour recherche par marque					
					$marque = '';
															
					//requete sql
					$sql_impr = "SELECT * 
								 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T
								 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
								 AND I.ID_MARQUE = M.ID_MARQUE ";
					
					
					
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
					
					if(isset($_POST['rech_type_impr']))
					{
						$sql_impr = "SELECT * 
									 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T
									 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
									 AND I.ID_MARQUE = M.ID_MARQUE 
									 AND T.ID_TYPE_IMPR = " .$_POST['type_impr'] ." ";
									 									   
						$rech = 'type_impr';
						$type_impr = $_POST['type_impr'];
												
					
					}
					else if(isset($_GET['type_impr']))
					{
						$sql_impr = "SELECT * 
									 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T
									 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
									 AND I.ID_MARQUE = M.ID_MARQUE 
									 AND T.ID_TYPE_IMPR = " .$_GET['type_impr'] ." ";
									 									   
						$rech = 'type_impr';
						$type_impr = $_GET['type_impr'];
											
					}
					else if(isset($_POST['rech_marque_impr']))
					{
						$sql_impr = "SELECT * 
									 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T
									 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
									 AND I.ID_MARQUE = M.ID_MARQUE 
									 AND M.ID_MARQUE = " .$_POST['marque'] ." ";
									 									   
						$rech = 'marque';
						$marque = $_POST['marque'];
						
					}
					else if(isset($_GET['marque']))
					{
						$sql_impr = "SELECT * 
									 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T
									 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
									 AND I.ID_MARQUE = M.ID_MARQUE 
									 AND M.ID_MARQUE = " .$_GET['marque'] ." ";
									 									   
						$rech = 'marque';
						$marque = $_GET['marque'];
						
					}
					else if(isset($_GET['retour'])  || isset($_POST['retour']))
					{
						$page = $_SESSION['page'];
						$rech = $_SESSION['rech'];
						$type_impr = $_SESSION['type_impr'];
						$marque = $_SESSION['marque'];
						$sql_impr = $_SESSION['sql_impr'];
					
					}
					
					
					$_SESSION['page'] = $page;
					$_SESSION['rech'] = $rech;
					$_SESSION['type_impr'] = $type_impr;
					$_SESSION['marque'] = $marque;
					$_SESSION['sql_impr'] = $sql_impr;
					
										
					if($res_i = mysql_query($sql_impr))
					{
						$nb_impr = mysql_num_rows($res_i);
						$max_page = $nb_impr / $impr_par_page;
						if(($max_page > 0) && ($max_page < 1))$max_page = 1;
						else $max_page = ceil($max_page);
						
						if($page > $max_page)
							$page = $max_page;
						
						$index = ($page - 1) * $impr_par_page;
						
						$sql_impr .= "LIMIT $index, $impr_par_page";
						
													
						if($nb_impr != 0)
						{
							
							if($res_impr = mysql_query($sql_impr))
							{
							
								$ch_page = "";
								$ch_psuiv = "";
								$ch_pprec = "";
						
					
				?>
				
								<table class="tab_conso">
						
									<tr>
										<td align="center" colspan="4" class="titre_fond_bleu25">
											Liste des imprimantes 
											
										</td>
									</tr>
									
									<tr>
										<td align="center" colspan="4" class="cell_page">
										
											<table class="tab_page">
												<tr>
													<td class="cell_pied_tabc">
														
														<?php
														
															$pp = $page - 1;
															$ch_pprec = '<a href="liste_imprimante.php?page=' .$pp;  
															
															if($rech == 'type_impr')
															{
																$ch_pprec .= "&type_impr=" .$type_impr;
															}
															else if($rech == 'marque')
															{
																$ch_pprec .= "&marque=" .$marque;	
																															
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
																	$ch_page .= '<a href="liste_imprimante.php?page=' .$i;
																	
																	if($rech == 'type_impr')
																	{
																		$ch_page .= "&type_impr=" .$type_impr;
																	}
																	else if($rech == 'marque')
																	{
																		$ch_page .= "&marque=" .$marque;	
																																	
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
															$ch_psuiv = '<a href="liste_imprimante.php?page=' .$ps;
															
															if($rech == 'type_impr')
															{
																$ch_psuiv .= "&type_impr=" .$type_impr;
															}
															else if($rech == 'marque')
															{
																$ch_psuiv .= "&marque=" .$marque;	
																															
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
										<td class="cell_ref_tab_impr">R&eacute;f&eacute;rence</td>
										<td class="cell_des_tab_impr">D&eacute;signation</td>
										<td class="cell_marque_tab_impr">Marque</td>
										<td class="cell_type_tab_impr">Type</td>
										
									</tr>
									
									
				<?php
								
								$blanc = true;
								
								while($imprimante = mysql_fetch_array($res_impr))
								{
																					
									if($blanc)
									{
									
				?>
										<tr>
											<td class="cell_tab_blanche"><a href="afficher_imprimante.php?ref_impr=<?php echo $imprimante['REF_IMPRIMANTE']; ?>"><?php echo $imprimante['REF_IMPRIMANTE']; ?></a></td>
											<td class="cell_tab_blanche"><a href="afficher_imprimante.php?ref_impr=<?php echo $imprimante['REF_IMPRIMANTE']; ?>"><?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?></a></td>
											<td class="cell_tab_blanche"><a href="afficher_imprimante.php?ref_impr=<?php echo $imprimante['REF_IMPRIMANTE']; ?>"><?php echo $imprimante['LIBELLE_MARQUE']; ?></a></td>
											<td class="cell_tab_blanche"><a href="afficher_imprimante.php?ref_impr=<?php echo $imprimante['REF_IMPRIMANTE']; ?>"><?php echo $imprimante['LIB_TYPE_IMPR']; ?></a></td>
											
											
											
												
										</tr>
								
				
				
				<?php
										
										$blanc = false;
										
									}
									else
									{
									
				?>
				
										<tr>
											<td class="cell_tab_bleu"><a href="afficher_imprimante.php?ref_impr=<?php echo $imprimante['REF_IMPRIMANTE']; ?>"><?php echo $imprimante['REF_IMPRIMANTE']; ?></a></td>
											<td class="cell_tab_bleu"><a href="afficher_imprimante.php?ref_impr=<?php echo $imprimante['REF_IMPRIMANTE']; ?>"><?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?></a></td>
											<td class="cell_tab_bleu"><a href="afficher_imprimante.php?ref_impr=<?php echo $imprimante['REF_IMPRIMANTE']; ?>"><?php echo $imprimante['LIBELLE_MARQUE']; ?></a></td>
											<td class="cell_tab_bleu"><a href="afficher_imprimante.php?ref_impr=<?php echo $imprimante['REF_IMPRIMANTE']; ?>"><?php echo $imprimante['LIB_TYPE_IMPR']; ?></a></td>
																							
										</tr>
				
						
				
				<?php
										$blanc = true;
									
									}
									
			
						
								
								
								}
								
				?>
									<tr>
										<td class="titre_fond_bleu25" colspan="4">
										
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
								
																
								<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso('imprimer_liste_impr.php?sql_impr=<?php echo addslashes(str_replace("
								", " ", $sql_impr)); ?>');">
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