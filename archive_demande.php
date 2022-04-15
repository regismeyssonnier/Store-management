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
					ARCHIVE - Archives des demandes
				</div>
				</center>
			
				<fieldset class="field_rech">
					<legend class="legend_rech">Rechercher par:</legend>
					<form action="archive_demande.php" method="post" id="form_date_dem" onsubmit="return Valider_form_date_etat();">
					<table class="tab_rechercher">
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Date de la demande
							</td>
						</tr>
						<tr>
							<td>Date :</td>
							<td valign="top">
								<input type="text" name="date_dem" value="" maxlength="10" size="10" />
							</td>
							<td align="right">
								<input type="submit" name="rech_date_dem" value="Rechercher"/>
							</td>
						</tr>
					</table>
					</form>
					
					<form action="archive_demande.php" method="post">
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
								<input type="submit" name="rech_div" value="Rechercher"/>
							</td>
						</tr>
					</table>
					</form>
					
					<form action="archive_demande.php" method="post">
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
								<input type="submit" name="rech_ser" value="Rechercher"/>
							</td>
						</tr>
					</table>
					</form>
				</fieldset>
				
				<?php
				
					$page = 1;
					//Affiche 30 consommables par page
					$demande_par_page = 1;
					//type de recherche
					$rech = '';
									
					//recherche par date demande
					$date = '';
					
					//recherche par division
					$division = '';
					
					//recherche par service
					$service = '';
					
					$sql_dem = "SELECT * FROM DEMANDE_ARCHIVE ";
														  
										
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
					
					
					if(isset($_POST['rech_date_dem']))
					{
						$t_d = split("/", $_POST['date_dem']);
										
						$sql_dem = "SELECT *
								    FROM DEMANDE_ARCHIVE
									WHERE DATE_DEMANDE = '" .$t_d[2] ."-" .$t_d[1] ."-" .$t_d[0] ."' ";
									
						$is_rech = true;
									
						$rech = "date";
						$date = $_POST['date_dem'];						
						
					}
					else if(isset($_GET['date']))
					{
						$t_d = split("/", $_GET['date']);
					
						$sql_dem = "SELECT *
								    FROM DEMANDE_ARCHIVE
									WHERE DATE_DEMANDE = '" .$t_d[2] ."-" .$t_d[1] ."-" .$t_d[0] ."' ";
									
						$is_rech = true;
									
						$rech = "date";
						$date = $_GET['date'];	
														
					}
					else if(isset($_POST['rech_div']))
					{
						if($_POST['division'] == 'Toute')
						{
							$sql_dem = "SELECT * FROM DEMANDE_ARCHIVE ";
						
						}
						else
						{
							$sql_dem = "SELECT * 
										FROM DEMANDE_ARCHIVE 
										WHERE DIVISION = '" .$_POST['division'] ."' ";
						}
						
						$is_rech = true;
						
						$rech = "division";
						$division = $_POST['division'];						
					
					}
					else if(isset($_GET['division']))
					{
						if($_GET['division'] == 'Toute')
						{
							$sql_dem = "SELECT * FROM DEMANDE_ARCHIVE ";
						
						}
						else
						{
							$sql_dem = "SELECT * 
										FROM DEMANDE_ARCHIVE
										WHERE DIVISION = '" .$_GET['division'] ."' ";
						}
						
						$is_rech = true;
						
						$rech = "division";
						$division = $_GET['division'];						
					
					}
					else if(isset($_POST['rech_ser']))
					{
						$sql_dem = "SELECT * 
									FROM DEMANDE_ARCHIVE 
									WHERE SERVICE = '" .$_POST['service'] ."' ";
						
						$is_rech = true;
						
						$rech = "service";
						$service = $_POST['service'];						
					
					}
					else if(isset($_GET['service']))
					{
						$sql_dem = "SELECT * 
									FROM DEMANDE_ARCHIVE
									WHERE SERVICE = '" .$_GET['service'] ."' ";
						
						$is_rech = true;
						
						$rech = "service";
						$service = $_GET['service'];						
					
					}
					else if(isset($_POST['retour']))
					{
						$page = $_SESSION['page'];
						$rech = $_SESSION['rech'];
						$date = $_SESSION['date'];
						$service = $_SESSION['service'];
						$division = $_SESSION['division'];
						$sql_dem = $_SESSION['sql_dem'];
					
						
					}
					
					$_SESSION['page'] = $page;
					$_SESSION['rech'] = $rech;
					$_SESSION['date'] = $date;
					$_SESSION['service'] = $service;
					$_SESSION['division'] = $division;
					$_SESSION['sql_dem'] = $sql_dem;
					
					       
					       
					
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
															$ch_pprec = '<a href="archive_demande.php?page=' .$pp;  
															
															if($rech == 'date')
															{
																$ch_pprec .= "&date=" .$date;	
																															
															}
															else if($rech == 'division')
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
																	$ch_page .= '<a href="archive_demande.php?page=' .$i;
																	
																	if($rech == 'date')
																	{
																		$ch_page .= "&date=" .$date;	
																																	
																	}
																	else if($rech == 'division')
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
															$ch_psuiv = '<a href="archive_demande.php?page=' .$ps;
															
															if($rech == 'date')
															{
																$ch_psuiv .= "&date=" .$date;	
																															
															}
															else if($rech == 'division')
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
											
										</td>
									</tr>	
									
									<tr>
										<td class="cell_date_traiter_dem">Date</td>
										<td class="cell_etat_traiter_dem">Etat</td>
										<td class="cell_division_traiter_dem">Division</td>
										<td class="cell_service_traiter_dem">Service</td>
										
									</tr>
									
					<?php
									
									$blanc = true;
									
									while($demande = mysql_fetch_array($res_dem))
									{
										$t_d = split("-", $demande['DATE_DEMANDE']);
										$date = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
																												
										if($blanc)
										{
																			
											
					?>
											<tr>
												<td class="cell_tab_blanche"><a href="afficher_demande_archive.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo $date; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_demande_archive.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo 'traitée'; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_demande_archive.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo $demande['DIVISION']; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_demande_archive.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo $demande['SERVICE']; ?></a></td>
																					
											</tr>
									
					
					
					<?php
											
											$blanc = false;
											
										}
										else
										{
										
					?>
					
											<tr>
												<td class="cell_tab_bleu"><a href="afficher_demande_archive.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo $date; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_demande_archive.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo 'traitée'; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_demande_archive.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo $demande['DIVISION']; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_demande_archive.php?num_dem=<?php echo $demande['NUM_DEMANDE']; ?>"><?php echo $demande['SERVICE']; ?></a></td>
																						
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
										
									
									</table>
					
				<?php
							
							
							
							
							}
						
						
						
						
						}
						else
						{
							if(!$is_rech)
								echo '<div class="texte_350_centre">Aucune demande archivée.</div>';
							else
								echo '<div class="texte_350_centre">Aucune demande ne correspond a votre recherche.</div>';
						
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