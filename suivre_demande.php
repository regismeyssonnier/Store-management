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
					DEMANDE - Suivre ses demandes
				</div>
				</center>
			
				<fieldset class="field_rech">
					<legend class="legend_rech">Rechercher par:</legend>
					<table class="tab_rechercher">
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Etat de la demande
							</td>
						</tr>
						<form action="suivre_demande.php" method="post">
						<tr>
							<td>Etat :</td>
							<td>
							<?php
							
								$sql_etat = "SELECT * FROM ETAT;";
								$res_e = mysql_query($sql_etat);
								
								echo '<select name="etat">';
								while($etat = mysql_fetch_array($res_e))
								{
									echo '<option value="' .$etat['NUM_ETAT'] .'">' .$etat['LIBELLE_ETAT'] .'</option>';

								}
								echo '</select>';
							
							?>
							</td>
							<td align="right">
								<input type="submit" name="rech_etat_dem" value="Rechercher"/>
							</td>
						</tr>
						</form>
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Date de la demande
							</td>
						</tr>
						<form action="suivre_demande.php" method="post" id="form_date_dem" onsubmit="return Valider_form_date_etat();">
						<tr>
							<td>Date :</td>
							<td valign="top">
								<input type="text" name="date_dem" value="" />
							</td>
							<td align="right">
								<input type="submit" name="rech_date_dem" value="Rechercher"/>
							</td>
						</tr>
						</form>
					</table>
				</fieldset>
				
				<?php
				
					$page = 1;
					//Affiche 30 consommables par page
					$demande_par_page = 5;
					//type de recherche
					$rech = '';
					
					//recherche par etat
					$etat = '';
					
					//recherche par date demande
					$date = '';
					
					//requete sql demande 
					$sql_dem = "SELECT *
								FROM DEMANDE 
								WHERE ID_UTILISATEUR_FAIRE = " .$_SESSION['id_util'] ." "
							  ."ORDER BY DATE_DEMANDE DESC, NUM_DEMANDE DESC ";
														  
					//indique si on utilise la requete etat
					$is_etat = false;
					
					//indique si on effectue une recherche
					$is_rech = false;
																					  
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
					
					
					if(isset($_POST['rech_etat_dem']))
					{
									 
						$sql_dem = "SELECT *
									FROM DEMANDE AS D, POSSEDER AS P, ETAT AS E
									WHERE D.NUM_DEMANDE = P.NUM_DEMANDE
									AND P.NUM_ETAT = E.NUM_ETAT
									AND E.NUM_ETAT = " .$_POST['etat'] ." "
								  ."AND ID_UTILISATEUR_FAIRE = " .$_SESSION['id_util'] ." "
								  ."AND D.NUM_DEMANDE NOT IN (SELECT D2.NUM_DEMANDE
															  FROM DEMANDE AS D2, POSSEDER AS P2, ETAT AS E2
															  WHERE D2.NUM_DEMANDE = P2.NUM_DEMANDE
															  AND P2.NUM_ETAT = E2.NUM_ETAT
															  AND E2.NUM_ETAT > " .$_POST['etat'] .") ";		  
						
											
						$is_etat = true;
						$is_rech = true;
						
						$rech = "etat";
						$etat = $_POST['etat'];
					
					}
					else if(isset($_GET['etat']))
					{
						$sql_dem = "SELECT *
									FROM DEMANDE AS D, POSSEDER AS P, ETAT AS E
									WHERE D.NUM_DEMANDE = P.NUM_DEMANDE
									AND P.NUM_ETAT = E.NUM_ETAT
									AND E.NUM_ETAT = " .$_GET['etat'] ." "
								  ."AND ID_UTILISATEUR_FAIRE = " .$_SESSION['id_util'] ." "
								  ."AND D.NUM_DEMANDE NOT IN (SELECT D2.NUM_DEMANDE
															  FROM DEMANDE AS D2, POSSEDER AS P2, ETAT AS E2
															  WHERE D2.NUM_DEMANDE = P2.NUM_DEMANDE
															  AND P2.NUM_ETAT = E2.NUM_ETAT
															  AND E2.NUM_ETAT > " .$_GET['etat'] .") ";
												
						$is_etat = true;
						$is_rech = true;
						
						$rech = "etat";
						$etat = $_GET['etat'];
					
					}
					else if(isset($_POST['rech_date_dem']))
					{
						$t_d = split("/", $_POST['date_dem']);
										
						$sql_dem = "SELECT *
								    FROM DEMANDE
									WHERE DATE_DEMANDE = '" .$t_d[2] ."-" .$t_d[1] ."-" .$t_d[0] ."' "
								  ."AND ID_UTILISATEUR_FAIRE = " .$_SESSION['id_util'] ." ";
						
						$is_rech = true;
						
						$rech = "date";
						$date = $_POST['date_dem'];						
						
					}
					else if(isset($_GET['date']))
					{
						$t_d = split("/", $_GET['date']);
					
						$sql_dem = "SELECT *
								    FROM DEMANDE
									WHERE DATE_DEMANDE = '" .$t_d[2] ."-" .$t_d[1] ."-" .$t_d[0] ."' "
								  ."AND ID_UTILISATEUR_FAIRE = " .$_SESSION['id_util'] ." ";
									
						$is_rech = true;
									
						$rech = "date";
						$date = $_GET['date'];	
														
					}
					else if(isset($_POST['retour']))
					{
						$page = $_SESSION['page'];
						$rech = $_SESSION['rech'];
						$etat = $_SESSION['etat'];
						$date = $_SESSION['date'];
						$sql_dem = $_SESSION['sql_dem'];
						$is_etat = $_SESSION['is_etat'];
						
					
					}
					
					$_SESSION['page'] = $page;
					$_SESSION['rech'] = $rech;
					$_SESSION['etat'] = $etat;
					$_SESSION['date'] = $date;
					$_SESSION['sql_dem'] = $sql_dem;
					$_SESSION['is_etat'] = $is_etat;
					
					
					if($res_d = mysql_query($sql_dem))
					{
						$nb_dem = mysql_num_rows($res_d);
						$max_page = $nb_dem / $demande_par_page;
						if(($max_page > 0) && ($max_page < 1))$max_page = 1;
						else $max_page = ceil($max_page);
						
						if($page > $max_page)
							$page = $max_page;
						
						$index = ($page - 1) * $demande_par_page;
						
						$sql_dem .= "LIMIT $index, $demande_par_page";
						
																		
						if($nb_dem != 0)
						{
							
							if($res_dem = mysql_query($sql_dem))
							{
							
								$ch_page = "";
								$ch_psuiv = "";
								$ch_pprec = "";
						
					
				?>
				
								<table class="tab_demande">
						
									<tr>
										<td align="center" colspan="4" class="titre_fond_bleu25">
											Liste des Demandes
										</td>
									</tr>
									
									<tr>
										<td align="center" colspan="4" class="cell_page">
										
											<table class="tab_page">
												<tr>
													<td class="cell_pied_tabc">
														
														<?php
														
															$pp = $page - 1;
															$ch_pprec = '<a href="suivre_demande.php?page=' .$pp;  
															
															if($rech == 'etat')
															{
																$ch_pprec .= "&etat=" .$etat;
															}
															else if($rech == 'date')
															{
																$ch_pprec .= "&date=" .$date;	
																															
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
																	$ch_page .= '<a href="suivre_demande.php?page=' .$i;
																	
																	if($rech == 'etat')
																	{
																		$ch_page .= "&etat=" .$etat;
																	}
																	else if($rech == 'date')
																	{
																		$ch_page .= "&date=" .$date;	
																																	
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
															$ch_psuiv = '<a href="suivre_demande.php?page=' .$ps;
															
															if($rech == 'etat')
															{
																$ch_psuiv .= "&etat=" .$etat;
															}
															else if($rech == 'date')
															{
																$ch_psuiv .= "&date=" .$date;	
																															
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
										<td class="cell_date_tab_demande">Date</td>
										<td class="cell_etat_tab_demande">Etat demande</td>
										<td class="cell_nomprenom_tab_demande">Fait par</td>
										
									</tr>
									
					<?php
									
									$blanc = true;
									
									while($demande = mysql_fetch_array($res_dem))
									{
										$etat = '';
										
										if(!$is_etat)
										{
											$sql_etat = "SELECT LIBELLE_ETAT
														 FROM ETAT, POSSEDER
														 WHERE ETAT.NUM_ETAT = POSSEDER.NUM_ETAT 
														 AND POSSEDER.NUM_DEMANDE = " .$demande['NUM_DEMANDE'] ." "
													   ."AND ETAT.NUM_ETAT = (SELECT MAX(E.NUM_ETAT) 
																			 FROM ETAT AS E, POSSEDER AS P 
																			 WHERE E.NUM_ETAT = P.NUM_ETAT 
																			 AND P.NUM_DEMANDE = " .$demande['NUM_DEMANDE'] .");";
												
											$res_e = mysql_query($sql_etat);
											$etat = mysql_fetch_array($res_e);
										
										}
										
										$t_d = split("-", $demande['DATE_DEMANDE']);
										$date = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
																			
										if($blanc)
										{
																			
											
					?>
											<tr>
												<td class="cell_tab_blanche"><a href="afficher_demande.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo $date; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_demande.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php  if(!$is_etat)echo $etat['LIBELLE_ETAT'];else echo $demande['LIBELLE_ETAT']; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_demande.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo $_SESSION['nom'] .' ' .$_SESSION['prenom']; ?></a></td>
																								
											</tr>
									
					
					
					<?php
											
											$blanc = false;
											
										}
										else
										{
										
					?>
					
											<tr>
												<td class="cell_tab_bleu"><a href="afficher_demande.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo $date; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_demande.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php if(!$is_etat)echo $etat['LIBELLE_ETAT'];else echo $demande['LIBELLE_ETAT']; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_demande.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo $_SESSION['nom'] .' ' .$_SESSION['prenom']; ?></a></td>
																								
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
					
				<?php
							
							
							
							
							}
						
						
						
						
						}
						else
						{
							if(!$is_rech)
								echo '<div class="texte_350_centre">Aucune demande n a ete traite.</div>';
							else
								echo '<div class="texte_350_centre">Aucune demande ne correspond a votre recherche.</div>';
						
						}
					
					
					}
					else
					{
						echo mysql_error();
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