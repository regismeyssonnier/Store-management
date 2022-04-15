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
					LIVRAISON - Liste des livraisons
				</div>
				</center>
			
				<fieldset class="field_rech">
					<legend class="legend_rech">Rechercher par:</legend>
					<table class="tab_rechercher">
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Numero de livraison
							</td>
						</tr>
						<form action="liste_livraison.php" method="post">
						<tr>
							<td>Num :</td>
							<td>
								<input type="text" name="num_livr" value="" />
							</td>
							<td align="right">
								<input type="submit" name="rech_num_livr" value="Rechercher"/>
							</td>
						</tr>
						</form>
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Date de la livraison
							</td>
						</tr>
						<form action="liste_livraison.php" method="post" id="form_date_livr" onsubmit="return Valider_date_form_livr('date_livr');">
						<tr>
							<td>Date :</td>
							<td valign="top">
								<input type="text" name="date_livr" id="date_livr" value="" />
							</td>
							<td align="right">
								<input type="submit" name="rech_date_livr" value="Rechercher"/>
							</td>
						</tr>
						</form>
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Numero de commande correspondant
							</td>
						</tr>
						<form action="liste_livraison.php" method="post">
						<tr>
							<td>Num :</td>
							<td valign="top">
							<?php
							
								$sql_com = "SELECT * FROM COMMANDE;";
								$res_c = mysql_query($sql_com);
								
								echo '<select name="num_com_livr">';
								while($commande = mysql_fetch_array($res_c))
								{
									echo '<option value="' .$commande['NUM_COMMANDE'] .'">' .$commande['NUM_COMMANDE'] .'</option>';
								
								}
								echo '</option>';
							
							?>	
							</td>
							<td align="right">
								<input type="submit" name="rech_num_com_livr" value="Rechercher"/>
							</td>
						</tr>
						</form>
					</table>
				</fieldset>
				
				<?php
				
					$page = 1;
					//Affiche 30 commandes par page
					$livraison_par_page = 1;
					//type de recherche
					$rech = '';
					
					//recherche par numero de commande
					$num_livr = '';
					
					//recherche par date commande
					$date = '';
					
					//recherche par num commande correspondant
					$commande = '';
					
					//requete sql demande traiter et pas vu
					$sql_livr = "SELECT * FROM LIVRAISON ORDER BY DATE_LIVRAISON DESC ";
														  
																										  
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
					
					
					if(isset($_POST['rech_num_livr']))
					{
									 
						$sql_livr = "SELECT *
									FROM LIVRAISON
									WHERE NUM_LIVRAISON LIKE '" .$_POST['num_livr'] ."%' 
									ORDER BY DATE_LIVRAISON DESC ";
									
						$rech = "num_livr";
						$num_livr = $_POST['num_livr'];
					
					}
					else if(isset($_GET['num_livr']))
					{
						$sql_livr = "SELECT *
									FROM LIVRAISON
									WHERE NUM_LIVRAISON LIKE '" .$_GET['num_livr'] ."%' 
									ORDER BY DATE_LIVRAISON DESC ";
									
						$rech = "num_livr";
						$num_livr = $_GET['num_livr'];
					
					}
					else if(isset($_POST['rech_date_livr']))
					{
						$t_d = split("/", $_POST['date_livr']);
										
						$sql_livr = "SELECT *
								     FROM LIVRAISON
									 WHERE DATE_LIVRAISON = '" .$t_d[2] ."-" .$t_d[1] ."-" .$t_d[0] ."' ";
						
						$rech = "date";
						$date = $_POST['date_livr'];						
						
					}
					else if(isset($_GET['date']))
					{
						$t_d = split("/", $_GET['date']);
										
						$sql_livr = "SELECT *
								    FROM LIVRAISON
									WHERE DATE_LIVRAISON = '" .$t_d[2] ."-" .$t_d[1] ."-" .$t_d[0] ."' ";
						
						$rech = "date";
						$date = $_GET['date'];	
														
					}
					else if(isset($_POST['rech_num_com_livr']))
					{
						$sql_livr = "SELECT *
									 FROM RECEVOIR AS R, LIVRAISON AS L
									 WHERE R.NUM_LIVRAISON = L.NUM_LIVRAISON
									 AND NUM_COMMANDE = '" .$_POST['num_com_livr'] ."' ";
						
						$rech = 'commande';
						$commande = $_POST['num_com_livr'];
					
					}
					else if(isset($_GET['commande']))
					{
						$sql_livr = "SELECT *
									 FROM RECEVOIR AS R, LIVRAISON AS L
									 WHERE R.NUM_LIVRAISON = L.NUM_LIVRAISON
									 AND NUM_COMMANDE = '" .$_GET['commande'] ."' ";
						
						$rech = 'commande';
						$commande = $_GET['commande'];
					
					}
					else if( isset($_POST['retour']) || isset($_GET['retour']) )
					{
						$page = $_SESSION['page'];
						$rech = $_SESSION['rech'];
						$num_livr = $_SESSION['num_livr'];
						$date = $_SESSION['date'];
						$sql_livr = $_SESSION['sql_livr'];
						$commande = $_SESSION['commande'];
												
					
					}
					
					$_SESSION['page'] = $page;
					$_SESSION['rech'] = $rech;
					$_SESSION['num_livr'] = $num_livr;
					$_SESSION['date'] = $date;
					$_SESSION['sql_livr'] = $sql_livr;
					$_SESSION['commande'] = $commande;
										
										
					if($res_l = mysql_query($sql_livr))
					{
						$nb_livr = mysql_num_rows($res_l);
						$max_page = $nb_livr / $livraison_par_page;
						if(($max_page > 0) && ($max_page < 1))$max_page = 1;
						else $max_page = ceil($max_page);
						
						if($page > $max_page)
							$page = $max_page;
						
						$index = ($page - 1) * $livraison_par_page;
						
						$sql_livr .= "LIMIT $index, $livraison_par_page";
						
																		
						if($nb_livr != 0)
						{
							
							if($res_livr = mysql_query($sql_livr))
							{
							
								$ch_page = "";
								$ch_psuiv = "";
								$ch_pprec = "";
						
					
				?>
				
								<table class="tab_liste_com">
						
									<tr>
										<td align="center" colspan="3" class="titre_fond_bleu25">
											Liste des Livraisons
										</td>
									</tr>
									
									<tr>
										<td align="center" colspan="3" class="cell_page">
										
											<table class="tab_page">
												<tr>
													<td class="cell_pied_tabc">
														
														<?php
														
															$pp = $page - 1;
															$ch_pprec = '<a href="liste_livraison.php?page=' .$pp;  
															
															if($rech == 'num_livr')
															{
																$ch_pprec .= "&num_livr=" .$num_livr;
															}
															else if($rech == 'date')
															{
																$ch_pprec .= "&date=" .$date;	
																															
															}
															else if($rech == 'commande')
															{
																$ch_pprec .= "&commande=" .$commande;	
																															
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
																	$ch_page .= '<a href="liste_livraison.php?page=' .$i;
																	
																	if($rech == 'num_livr')
																	{
																		$ch_page .= "&num_livr=" .$num_livr;
																	}
																	else if($rech == 'date')
																	{
																		$ch_page .= "&date=" .$date;	
																																	
																	}
																	else if($rech == 'commande')
																	{
																		$ch_page .= "&commande=" .$commande;	
																																	
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
															$ch_psuiv = '<a href="liste_livraison.php?page=' .$ps;
															
															if($rech == 'num_livr')
															{
																$ch_psuiv .= "&num_livr=" .$num_livr;
															}
															else if($rech == 'date')
															{
																$ch_psuiv .= "&date=" .$date;	
																															
															}
															else if($rech == 'commande')
															{
																$ch_psuiv .= "&commande=" .$commande;	
																															
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
										<td class="cell_date_tab_commande">Date</td>
										<td class="cell_etat_tab_commande">Num Commande</td>
										<td class="cell_nomprenom_tab_commande">Fait par</td>
										
									</tr>
									
					<?php
									
									$blanc = true;
									
									while($livraison = mysql_fetch_array($res_livr))
									{
										$sql_util = "SELECT * FROM UTILISATEUR WHERE ID_UTILISATEUR = " .$livraison['ID_UTILISATEUR'] .";";
										$res_u = mysql_query($sql_util);
										$util = mysql_fetch_array($res_u);
										
										$t_d = split("-", $livraison['DATE_LIVRAISON']);
										$date = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
																													
										if($blanc)
										{
																			
											
					?>
											<tr>
												<td class="cell_tab_blanche"><a href="afficher_livraison.php?num_livr=<?php echo $livraison['NUM_LIVRAISON']; ?>"><?php echo $date; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_livraison.php?num_livr=<?php echo $livraison['NUM_LIVRAISON']; ?>"><?php echo $livraison['NUM_LIVRAISON']; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_livraison.php?num_livr=<?php echo $livraison['NUM_LIVRAISON']; ?>"><?php echo $util['NOM_UTILISATEUR'] ." " .$util['PRENOM_UTILISATEUR']; ?></a></td>
																								
											</tr>
									
					
					
					<?php
											
											$blanc = false;
											
										}
										else
										{
										
					?>
					
											<tr>
												<td class="cell_tab_bleu"><a href="afficher_livraison.php?num_livr=<?php echo $livraison['NUM_LIVRAISON']; ?>"><?php echo $date; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_livraison.php?num_livr=<?php echo $livraison['NUM_LIVRAISON']; ?>"><?php echo $livraison['NUM_LIVRAISON']; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_livraison.php?num_livr=<?php echo $livraison['NUM_LIVRAISON']; ?>"><?php echo $util['NOM_UTILISATEUR'] ." " .$util['PRENOM_UTILISATEUR']; ?></a></td>
																								
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
					
				<?php
							
							
							
							
							}
						
						
						
						
						}
						else
						{
							echo '<div class="texte_350_centre">Aucune Livraison ne correspond a votre recherche.</div>';
						
						}
					
					
					}
					else
					{
						echo '<div class="texte_350_centre">' .mysql_error() .'</div>';
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