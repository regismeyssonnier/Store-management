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
					COMMANDE - Liste des commandes
				</div>
				</center>
			
				<fieldset class="field_rech">
					<legend class="legend_rech">Rechercher par:</legend>
					<table class="tab_rechercher">
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Numero de commande
							</td>
						</tr>
						<form action="liste_commande.php" method="post">
						<tr>
							<td>Num :</td>
							<td>
								<input type="text" name="num_com" value="" />
							</td>
							<td align="right">
								<input type="submit" name="rech_num_com" value="Rechercher"/>
							</td>
						</tr>
						</form>
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Date de la commande
							</td>
						</tr>
						<form action="liste_commande.php" method="post" id="form_date_com" onsubmit="return Valider_form_date_com();">
						<tr>
							<td>Date :</td>
							<td valign="top">
								<input type="text" name="date_com" value="" />
							</td>
							<td align="right">
								<input type="submit" name="rech_date_com" value="Rechercher"/>
							</td>
						</tr>
						</form>
					</table>
				</fieldset>
				
				<?php
				
					$page = 1;
					//Affiche 30 commandes par page
					$commande_par_page = 1;
					//type de recherche
					$rech = '';
					
					//recherche par numero de commande
					$num_com = '';
					
					//recherche par date commande
					$date = '';
					
					//requete sql demande traiter et pas vu
					$sql_com = "SELECT * FROM COMMANDE ORDER BY DATE_COMMANDE DESC ";
														  
																										  
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
					
					
					if(isset($_POST['rech_num_com']))
					{
									 
						$sql_com = "SELECT *
									FROM COMMANDE
									WHERE NUM_COMMANDE LIKE '" .$_POST['num_com'] ."%' 
									ORDER BY DATE_COMMANDE DESC ";
									
						$rech = "num_com";
						$num_com = $_POST['num_com'];
					
					}
					else if(isset($_GET['num_com']))
					{
						$sql_com = "SELECT *
									FROM COMMANDE
									WHERE NUM_COMMANDE LIKE '" .$_GET['num_com'] ."%' 
									ORDER BY DATE_COMMANDE DESC ";
									
						$rech = "num_com";
						$num_com = $_GET['num_com'];
					
					}
					else if(isset($_POST['rech_date_com']))
					{
						$t_d = split("/", $_POST['date_com']);
										
						$sql_com = "SELECT *
								    FROM COMMANDE
									WHERE DATE_COMMANDE = '" .$t_d[2] ."-" .$t_d[1] ."-" .$t_d[0] ."' ";
						
						$rech = "date";
						$date = $_POST['date_com'];						
						
					}
					else if(isset($_GET['date']))
					{
						$t_d = split("/", $_GET['date']);
										
						$sql_com = "SELECT *
								    FROM COMMANDE
									WHERE DATE_COMMANDE = '" .$t_d[2] ."-" .$t_d[1] ."-" .$t_d[0] ."' ";
						
						$rech = "date";
						$date = $_GET['date'];	
														
					}
					else if( isset($_POST['retour']) || isset($_GET['retour']) )
					{
						$page = $_SESSION['page'];
						$rech = $_SESSION['rech'];
						$num_com = $_SESSION['num_com'];
						$date = $_SESSION['date'];
						$sql_com = $_SESSION['sql_com'];
												
					
					}
					
					$_SESSION['page'] = $page;
					$_SESSION['rech'] = $rech;
					$_SESSION['num_com'] = $num_com;
					$_SESSION['date'] = $date;
					$_SESSION['sql_com'] = $sql_com;
										
										
					if($res_c = mysql_query($sql_com))
					{
						$nb_com = mysql_num_rows($res_c);
						$max_page = $nb_com / $commande_par_page;
						if(($max_page > 0) && ($max_page < 1))$max_page = 1;
						else $max_page = ceil($max_page);
						
						if($page > $max_page)
							$page = $max_page;
						
						$index = ($page - 1) * $commande_par_page;
						
						$sql_com .= "LIMIT $index, $commande_par_page";
						
																		
						if($nb_com != 0)
						{
							
							if($res_com = mysql_query($sql_com))
							{
							
								$ch_page = "";
								$ch_psuiv = "";
								$ch_pprec = "";
						
					
				?>
				
								<table class="tab_liste_com">
						
									<tr>
										<td align="center" colspan="4" class="titre_fond_bleu25">
											Liste des Commandes
										</td>
									</tr>
									
									<tr>
										<td align="center" colspan="4" class="cell_page">
										
											<table class="tab_page">
												<tr>
													<td class="cell_pied_tabc">
														
														<?php
														
															$pp = $page - 1;
															$ch_pprec = '<a href="liste_commande.php?page=' .$pp;  
															
															if($rech == 'num_com')
															{
																$ch_pprec .= "&num_com=" .$num_com;
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
																	$ch_page .= '<a href="liste_commande.php?page=' .$i;
																	
																	if($rech == 'num_com')
																	{
																		$ch_page .= "&num_com=" .$num_com;
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
															$ch_psuiv = '<a href="liste_commande.php?page=' .$ps;
															
															if($rech == 'num_com')
															{
																$ch_psuiv .= "&num_com=" .$num_com;
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
										<td class="cell_date_tab_commande">Date</td>
										<td class="cell_etat_tab_commande">Num Commande</td>
										<td class="cell_nomprenom_tab_commande">Fait par</td>
										
									</tr>
									
					<?php
									
									$blanc = true;
									
									while($commande = mysql_fetch_array($res_com))
									{
										$sql_util = "SELECT * FROM UTILISATEUR WHERE ID_UTILISATEUR = " .$commande['ID_UTILISATEUR'] .";";
										$res_u = mysql_query($sql_util);
										$util = mysql_fetch_array($res_u);
										
										$t_d = split("-", $commande['DATE_COMMANDE']);
										$date = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
																													
										if($blanc)
										{
																			
											
					?>
											<tr>
												<td class="cell_tab_blanche"><a href="afficher_commande.php?num_com=<?php echo $commande['NUM_COMMANDE']; ?>"><?php echo $date; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_commande.php?num_com=<?php echo $commande['NUM_COMMANDE']; ?>"><?php echo $commande['NUM_COMMANDE']; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_commande.php?num_com=<?php echo $commande['NUM_COMMANDE']; ?>"><?php echo $util['NOM_UTILISATEUR'] ." " .$util['PRENOM_UTILISATEUR']; ?></a></td>
																								
											</tr>
									
					
					
					<?php
											
											$blanc = false;
											
										}
										else
										{
										
					?>
					
											<tr>
												<td class="cell_tab_bleu"><a href="afficher_commande.php?num_com=<?php echo $commande['NUM_COMMANDE']; ?>"><?php echo $date; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_commande.php?num_com=<?php echo $commande['NUM_COMMANDE']; ?>"><?php echo $commande['NUM_COMMANDE']; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_commande.php?num_com=<?php echo $commande['NUM_COMMANDE']; ?>"><?php echo $util['NOM_UTILISATEUR'] ." " .$util['PRENOM_UTILISATEUR']; ?></a></td>
																								
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
							echo '<div class="texte_350_centre">Aucune Commande ne correspond a votre recherche.</div>';
						
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