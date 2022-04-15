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
					IMPRIMANTE - Nb imprimantes par services
				</div>
				</center>
			
				<fieldset class="field_rech">
					<legend class="legend_rech">Rechercher par:</legend>
						<form action="nb_imprimante_par_service.php" method="post">
						<table class="tab_rechercher">
							<tr>
								<td colspan="3" class="titre_fond_bleuclairfonce">
									Division
								</td>
							</tr>
							
							<tr>
								<td class="cell_75_simple">Division :</td>
								<td>
								<?php
								
									$sql_division = "SELECT * FROM DIVISION;";
									$res_d = mysql_query($sql_division);
									
									echo '<select name="division" id="division" onchange="Changer_select_service_impr();">';
									echo '<option value="Toute">Toute</option>';
									while($division = mysql_fetch_array($res_d))
									{
										echo '<option value="' .$division['ID_DIVISION'] .'">' .$division['NOM_DIVISION'] .'</option>';								
									}
									echo '</select>';
									
								
								?>
								</td>
								<td align="right">
									<input type="submit" name="rech_division" value="Rechercher" />
								</td>
							</tr>
						</table>
						</form>
						
						<form action="nb_imprimante_par_service.php" method="post">
						<table class="tab_rechercher">
							<tr>
								<td colspan="3" class="titre_fond_bleuclairfonce">
									Service
								</td>
							</tr>
							
							<tr>
								<td class="cell_75_simple">Service :</td>
								<td id="zone_sel_service">
								<?php
								
									include('select_service_impr.php');
								
								?>
								</td>
								<td align="right">
									<input type="submit" name="rech_service" value="Rechercher"/>
								</td>
							</tr>
						</table>
						</form>
					
				</fieldset>
				
				<?php
				
					$page = 1;
					//Affiche 30 imprimantes par page
					$impr_par_page = 2;
					//type de recherche
					$rech = '';
					
					//pour recherche par division
					$division = '';
					//si toute division
					$sel_div = '';
					//pour recherche par service
					$service = '';
										
					//requete sql
					$sql_impr = "SELECT I.REF_IMPRIMANTE, DESIGNATION_IMPRIMANTE, LIBELLE_MARQUE, LIB_TYPE_IMPR, COUNT(*) 
								 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T, IMPR_EN_SERVICE AS IM
								 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
								 AND I.ID_MARQUE = M.ID_MARQUE 
								 AND IM.REF_IMPRIMANTE = I.REF_IMPRIMANTE 
								 GROUP BY REF_IMPRIMANTE ";
					
					
					
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
					
					if(isset($_POST['rech_division']))
					{
						if($_POST['division'] == 'Toute')
						{
							$sql_impr = "SELECT I.REF_IMPRIMANTE, DESIGNATION_IMPRIMANTE, LIBELLE_MARQUE, LIB_TYPE_IMPR, COUNT(*) 
										 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T, IMPR_EN_SERVICE AS IM
										 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
										 AND I.ID_MARQUE = M.ID_MARQUE 
										 AND IM.REF_IMPRIMANTE = I.REF_IMPRIMANTE 
										 GROUP BY REF_IMPRIMANTE ";
						
						}
						else
						{
							$sql_impr = "SELECT I.REF_IMPRIMANTE, DESIGNATION_IMPRIMANTE, LIBELLE_MARQUE, LIB_TYPE_IMPR, COUNT(*) 
										 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T, IMPR_EN_SERVICE AS IES, SERVICE AS SER
										 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
										 AND I.ID_MARQUE = M.ID_MARQUE 
										 AND I.REF_IMPRIMANTE = IES.REF_IMPRIMANTE
										 AND IES.ID_SERVICE = SER.ID_SERVICE
										 AND SER.ID_DIVISION = '" .$_POST['division'] ."' 
										 GROUP BY REF_IMPRIMANTE ";
						}
									 
						$rech = 'division';
						$division = $_POST['division'];
						
					
					}
					else if(isset($_GET['division']))
					{
						if($_GET['division'] == 'Toute')
						{
							$sql_impr = "SELECT I.REF_IMPRIMANTE, DESIGNATION_IMPRIMANTE, LIBELLE_MARQUE, LIB_TYPE_IMPR, COUNT(*) 
										 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T, IMPR_EN_SERVICE AS IM
										 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
										 AND I.ID_MARQUE = M.ID_MARQUE 
										 AND IM.REF_IMPRIMANTE = I.REF_IMPRIMANTE 
										 GROUP BY REF_IMPRIMANTE ";
						
						}
						else
						{
							$sql_impr = "SELECT I.REF_IMPRIMANTE, DESIGNATION_IMPRIMANTE, LIBELLE_MARQUE, LIB_TYPE_IMPR, COUNT(*)
										 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T, IMPR_EN_SERVICE AS IES, SERVICE AS SER
										 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
										 AND I.ID_MARQUE = M.ID_MARQUE 
										 AND I.REF_IMPRIMANTE = IES.REF_IMPRIMANTE
										 AND IES.ID_SERVICE = SER.ID_SERVICE
										 AND SER.ID_DIVISION = '" .$_GET['division'] ."' 
										 GROUP BY REF_IMPRIMANTE ";
						}
									 
						$rech = 'division';
						$division = $_GET['division'];
						
					
					}
					else if(isset($_POST['rech_service']))
					{
						$sql_impr = "SELECT I.REF_IMPRIMANTE, DESIGNATION_IMPRIMANTE, LIBELLE_MARQUE, LIB_TYPE_IMPR, COUNT(*) 
									 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T, IMPR_EN_SERVICE AS IES
									 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
									 AND I.ID_MARQUE = M.ID_MARQUE 
									 AND I.REF_IMPRIMANTE = IES.REF_IMPRIMANTE
									 AND IES.ID_SERVICE = '" .$_POST['service'] ."' 
									 GROUP BY REF_IMPRIMANTE ";
									 
						$rech = 'service';
						$service = $_POST['service'];
					
					
					}
					else if(isset($_GET['service']))
					{
						$sql_impr = "SELECT I.REF_IMPRIMANTE, DESIGNATION_IMPRIMANTE, LIBELLE_MARQUE, LIB_TYPE_IMPR, COUNT(*)
									 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T, IMPR_EN_SERVICE AS IES
									 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
									 AND I.ID_MARQUE = M.ID_MARQUE 
									 AND I.REF_IMPRIMANTE = IES.REF_IMPRIMANTE
									 AND IES.ID_SERVICE = '" .$_GET['service'] ."' 
									 GROUP BY REF_IMPRIMANTE ";
									 
						$rech = 'service';
						$service = $_GET['service'];
					
					
					}
					else if(isset($_GET['retour'])  || isset($_POST['retour']))
					{
						$page = $_SESSION['page'];
						$rech = $_SESSION['rech'];
						$sql_impr = $_SESSION['sql_impr'];
					
					}
					
					
					$_SESSION['page'] = $page;
					$_SESSION['rech'] = $rech;
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
										<td align="center" colspan="5" class="titre_fond_bleu25">
											Liste des imprimantes 
											<?php 
												if($division == 'Toute')echo "de toutes les divisions";
												else if($division != '')echo "de la division " .$division;
												if($service != '')echo "du service " .$service;
											?>
										</td>
									</tr>
									
									<tr>
										<td align="center" colspan="5" class="cell_page">
										
											<?php
												
												$page_div = '';
												if((@$_POST['division'] == 'Toute') || (@$_GET['division'] == 'Toute'))
												{
													$sql_division = "SELECT * FROM DIVISION;";
													$res_d = mysql_query($sql_division);
													$p = true;
													while($div = mysql_fetch_array($res_d))
													{
														if($p)
														{
															$page_div .= '<a class="lien_blanc" href="nb_imprimante_par_service.php?division=Toute&sel_div=' .$div['ID_DIVISION'] .'">' .$div['ID_DIVISION'] .'</a>';
															$p = false;
														}
														else
														{
															$page_div .= ' - <a class="lien_blanc" href="nb_imprimante_par_service.php?division=Toute&sel_div=' .$div['ID_DIVISION'] .'">' .$div['ID_DIVISION'] .'</a>';
														}
														
													}
													
													echo $page_div;
												
												}
												else
												{
										
											?>
										
													<table class="tab_page">
														<tr>
															<td class="cell_pied_tabc">
																
																<?php
																
																	$pp = $page - 1;
																	$ch_pprec = '<a href="nb_imprimante_par_service.php?page=' .$pp;  
																	
																	if($rech == 'division')
																	{
																		$ch_pprec .= "&division=" .$division;	
																																	
																	}
																	else if($rech == 'service')
																	{
																		$ch_pprec .= "&service=" .$service;	
																																	
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
																			$ch_page .= '<a href="nb_imprimante_par_service.php?page=' .$i;
																			
																			if($rech == 'division')
																			{
																				$ch_page .= "&division=" .$division;	
																																			
																			}
																			else if($rech == 'service')
																			{
																				$ch_page .= "&service=" .$service;	
																																			
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
																	$ch_psuiv = '<a href="nb_imprimante_par_service.php?page=' .$ps;
																	
																	if($rech == 'division')
																	{
																		$ch_psuiv .= "&division=" .$division;	
																																	
																	}
																	else if($rech == 'service')
																	{
																		$ch_psuiv .= "&service=" .$service;	
																																	
																	}
															
																	$ch_psuiv .= '" class="lien_blanc">page suiv >></a>';
																
																	if($page < $max_page)						
																		echo $ch_psuiv;
																
																?>
																
																
															</td>
														</tr>
													</table>
											<?php
											
												}
											
											?>
											
										</td>
									</tr>	
				
				<?php
				
								if((@$_POST['division'] == 'Toute') || (@$_GET['division'] == 'Toute'))
								{
				
									
									if(@$_POST['division'] == 'Toute')
									{
										echo '<tr>';
										echo '<td align="center" colspan="5" class="titre_fond_bleu25">';
										$sql_d = "SELECT * FROM DIVISION;";
										$res_d = mysql_query($sql_d);
										$div = mysql_fetch_array($res_d);
										echo $div['ID_DIVISION'];
										echo '</td></tr>';
										$sel_div = $div['ID_DIVISION'];
		
					
									}
									else if(@$_GET['division'] == 'Toute')
									{
										echo '<tr>';
										echo '<td align="center" colspan="5" class="titre_fond_bleu25">';
										echo $_GET['sel_div'];
										echo '</td></tr>';
										$sel_div = $_GET['sel_div'];
									}
									
									$sql_s = "SELECT * FROM SERVICE WHERE ID_DIVISION = '" .$sel_div ."';";
									$res_s = mysql_query($sql_s);
									
									while($service = mysql_fetch_array($res_s))
									{
										echo '<tr>';
										echo '<td align="center" colspan="5" class="titre_fond_blanc">';
										echo $service['ID_SERVICE'];
										echo '</td></tr>';
										
				?>
										<tr>
											<td class="cell_ref_tab_impr_ser">R&eacute;f&eacute;rence</td>
											<td class="cell_des_tab_impr_ser">D&eacute;signation</td>
											<td class="cell_marque_tab_impr_ser">Marque</td>
											<td class="cell_type_tab_impr_ser">Type</td>
											<td class="cell_annee_tab_impr_ser">Nb</td>
											
										</tr>
									
				<?php
				
										$blanc = true;
																							 
										$sql_impr = "SELECT I.REF_IMPRIMANTE, DESIGNATION_IMPRIMANTE, LIBELLE_MARQUE, LIB_TYPE_IMPR, COUNT(*)
													 FROM IMPRIMANTE AS I, MARQUE AS M, TYPE_IMPRIMANTE AS T, IMPR_EN_SERVICE AS IES
													 WHERE I.ID_TYPE_IMPR = T.ID_TYPE_IMPR
													 AND I.ID_MARQUE = M.ID_MARQUE 
													 AND I.REF_IMPRIMANTE = IES.REF_IMPRIMANTE
													 AND IES.ID_SERVICE = '" .$service['ID_SERVICE'] ."' 
													 GROUP BY REF_IMPRIMANTE ";
													 
										$res_i = mysql_query($sql_impr);
										if(mysql_num_rows($res_i) > 0)
										{
												
											while($imprimante = mysql_fetch_array($res_i))
											{
																								
												if($blanc)
												{
									
				?>
													<tr>
														<td class="cell_tab_blanche"><?php echo $imprimante['REF_IMPRIMANTE']; ?></td>
														<td class="cell_tab_blanche"><?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?></td>
														<td class="cell_tab_blanche"><?php echo $imprimante['LIBELLE_MARQUE']; ?></td>
														<td class="cell_tab_blanche"><?php echo $imprimante['LIB_TYPE_IMPR']; ?></td>
														<td class="cell_tab_blanche"><?php echo $imprimante[4]; ?></td>
																				
													</tr>
								
				
				
				<?php
										
													$blanc = false;
											
												}
												else
												{
									
				?>
				
													<tr>
														<td class="cell_tab_bleu"><?php echo $imprimante['REF_IMPRIMANTE']; ?></td>
														<td class="cell_tab_bleu"><?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?></td>
														<td class="cell_tab_bleu"><?php echo $imprimante['LIBELLE_MARQUE']; ?></td>
														<td class="cell_tab_bleu"><?php echo $imprimante['LIB_TYPE_IMPR']; ?></td>
														<td class="cell_tab_bleu"><?php echo $imprimante[4]; ?></td>
																									
													</tr>
				
						
				
				<?php
													$blanc = true;
										
												}
									
			
						
								
								
											}
								
			
											
											
											
										}
										else
										{
											echo '<tr><td colspan=5" align="center">Aucune imprimante dans ce service</td></tr>';
										
										}
										
										
								
									}
									
									echo '<tr>';
									echo '<td align="center" colspan="5" class="titre_fond_bleu25">';
									echo $page_div;
									echo '</td></tr>';
									
									
									
								}
								else
								{
				?>
									
									<tr>
										<td class="cell_ref_tab_impr_ser">R&eacute;f&eacute;rence</td>
										<td class="cell_des_tab_impr_ser">D&eacute;signation</td>
										<td class="cell_marque_tab_impr_ser">Marque</td>
										<td class="cell_type_tab_impr_ser">Type</td>
										<td class="cell_annee_tab_impr_ser">Nb</td>
										
									</tr>
									
									
				<?php
								
									$blanc = true;
									
									while($imprimante = mysql_fetch_array($res_impr))
									{
																						
										if($blanc)
										{
									
				?>
											<tr>
												<td class="cell_tab_blanche"><?php echo $imprimante['REF_IMPRIMANTE']; ?></td>
												<td class="cell_tab_blanche"><?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?></td>
												<td class="cell_tab_blanche"><?php echo $imprimante['LIBELLE_MARQUE']; ?></td>
												<td class="cell_tab_blanche"><?php echo $imprimante['LIB_TYPE_IMPR']; ?></td>
												<td class="cell_tab_blanche"><?php echo $imprimante[4]; ?></td>
																		
											</tr>
								
				
				
				<?php
										
											$blanc = false;
											
										}
										else
										{
									
				?>
				
											<tr>
												<td class="cell_tab_bleu"><?php echo $imprimante['REF_IMPRIMANTE']; ?></td>
												<td class="cell_tab_bleu"><?php echo $imprimante['DESIGNATION_IMPRIMANTE']; ?></td>
												<td class="cell_tab_bleu"><?php echo $imprimante['LIBELLE_MARQUE']; ?></td>
												<td class="cell_tab_bleu"><?php echo $imprimante['LIB_TYPE_IMPR']; ?></td>
												<td class="cell_tab_bleu"><?php echo $imprimante[4]; ?></td>
																							
											</tr>
				
						
				
				<?php
											$blanc = true;
										
										}
									
			
						
								
								
									}
								
				?>
									<tr>
										<td class="titre_fond_bleu25" colspan="5">
										
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
				<?php

								}

				?>
								
								</table>
								
								<?php
									$p_url = '';
									if($service != '')
										$p_url = "&service=" .$service;
									
									if($division != '')
									{
										$p_url .= "&division=" .$division;
										if($division == 'Toute')
											$p_url .= "&sel_div=" .$sel_div;
									}
								
								?>
								
								<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso('imprimer_liste_nb_impr_serv.php?sql_impr=<?php echo addslashes(str_replace("
								", " ", $sql_impr)) .$p_url; ?>');">
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