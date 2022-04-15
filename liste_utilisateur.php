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
					CONFIGURATION - Liste utilisateur
				</div>
				</center>
			
				<fieldset class="field_rech">
					<legend class="legend_rech">Rechercher par:</legend>
					<table class="tab_rechercher">
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Nom
							</td>
						</tr>
						<form action="liste_utilisateur.php" method="post">
						<tr>
							<td>Nom :</td>
							<td>
								<input type="text" name="nom" value="" size="50" maxlength="50" />
							</td>
							<td align="right">
								<input type="submit" name="rech_nom_util" value="Rechercher"/>
							</td>
						</tr>
						</form>
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Service
							</td>
						</tr>
						<form action="liste_utilisateur.php" method="post">
						<tr>
							<td>Service :</td>
							<td valign="top">
							<?php
							
								$sql_serv = "SELECT * FROM SERVICE;";
								$res_s = mysql_query($sql_serv);
								
								echo '<select name="service">';
								while($serv = mysql_fetch_array($res_s))
								{
									echo '<option value="' .$serv['ID_SERVICE'] .'">' .$serv['ID_SERVICE'] .'</option>';
								
								}
								echo '</select>';
							
							?>
							</td>
							<td align="right">
								<input type="submit" name="rech_serv_util" value="Rechercher"/>
							</td>
						</tr>
						</form>
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Type
							</td>
						</tr>
						<form action="liste_utilisateur.php" method="post">
						<tr>
							<td>Type :</td>
							<td valign="top">
							<?php
							
								$sql_tutil = "SELECT * FROM TYPE_UTIL;";
								$res_tu = mysql_query($sql_tutil);
								
								echo '<select name="tp_util">';
								while($tutil = mysql_fetch_array($res_tu))
								{
									echo '<option value="' .$tutil['ID_TYPE_UTIL'] .'">' .$tutil['LIBELLE_TYPE_UTIL'] .'</option>';
								
								}
								echo '</select>';
							
							?>	
							</td>
							<td align="right">
								<input type="submit" name="rech_tp_util" value="Rechercher"/>
							</td>
						</tr>
						</form>
					</table>
				</fieldset>
				
				<?php
				
					$page = 1;
					//Affiche 30 commandes par page
					$utilisateur_par_page = 1;
					//type de recherche
					$rech = '';
					
					//recherche par nom
					$nom = '';
					
					//recherche par service
					$service = '';
					
					//recherche par type
					$type = '';
					
					//requete sql demande traiter et pas vu
					$sql_util = "SELECT * FROM UTILISATEUR ORDER BY NOM_UTILISATEUR ";
														  
																										  
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
					
					
					if(isset($_POST['rech_nom_util']))
					{
									 
						$sql_util = "SELECT *
									 FROM UTILISATEUR
									 WHERE NOM_UTILISATEUR LIKE '" .$_POST['nom'] ."%' ";
									
						$rech = "nom";
						$nom = $_POST['nom'];
					
					}
					else if(isset($_GET['nom']))
					{
						$sql_util = "SELECT *
									 FROM UTILISATEUR
									 WHERE NOM_UTILISATEUR LIKE '%" .$_GET['nom'] ."%' ";
									
						$rech = "nom";
						$nom = $_GET['nom'];
					
					}
					else if(isset($_POST['rech_serv_util']))
					{
															
						$sql_util = "SELECT *
									 FROM UTILISATEUR
									 WHERE ID_SERVICE = '" .$_POST['service'] ."' ";
						
						$rech = "service";
						$service = $_POST['service'];						
						
					}
					else if(isset($_GET['service']))
					{
						$sql_util = "SELECT *
									 FROM UTILISATEUR
									 WHERE ID_SERVICE = '" .$_GET['service'] ."' ";
						
						$rech = "service";
						$service = $_GET['service'];	
														
					}
					else if(isset($_POST['rech_tp_util']))
					{
						$sql_util = "SELECT *
									 FROM UTILISATEUR
									 WHERE ID_TYPE_UTIL = " .$_POST['tp_util'] ." ";
												
						$rech = 'type';
						$type = $_POST['tp_util'];
					
					}
					else if(isset($_GET['type']))
					{
						$sql_util = "SELECT *
									 FROM UTILISATEUR
									 WHERE ID_TYPE_UTIL = " .$_GET['type'] ." ";
												
						$rech = 'type';
						$type = $_GET['type'];
					
					}
					else if( isset($_POST['retour']) || isset($_GET['retour']) )
					{
						$page = $_SESSION['page'];
						$rech = $_SESSION['rech'];
						$nom = $_SESSION['nom'];
						$service = $_SESSION['service'];
						$type = $_SESSION['type'];
						
					}
					
					$_SESSION['page'] = $page;
					$_SESSION['rech'] = $rech;
					$_SESSION['nom'] = $nom;
					$_SESSION['service'] = $service;
					$_SESSION['type'] = $type;
									
										
					if($res_u = mysql_query($sql_util))
					{
						$nb_util = mysql_num_rows($res_u);
						$max_page = $nb_util / $utilisateur_par_page;
						if(($max_page > 0) && ($max_page < 1))$max_page = 1;
						else $max_page = ceil($max_page);
						
						if($page > $max_page)
							$page = $max_page;
						
						$index = ($page - 1) * $utilisateur_par_page;
						
						$sql_util .= "LIMIT $index, $utilisateur_par_page";
						
																		
						if($nb_util != 0)
						{
							
							if($res_util = mysql_query($sql_util))
							{
							
								$ch_page = "";
								$ch_psuiv = "";
								$ch_pprec = "";
						
					
				?>
				
								<table class="tab_liste_com">
						
									<tr>
										<td align="center" colspan="5" class="titre_fond_bleu25">
											Liste des utilisateurs
										</td>
									</tr>
									
									<tr>
										<td align="center" colspan="5" class="cell_page">
										
											<table class="tab_page">
												<tr>
													<td class="cell_pied_tabc">
														
														<?php
														
															$pp = $page - 1;
															$ch_pprec = '<a href="liste_utilisateur.php?page=' .$pp;  
															
															if($rech == 'nom')
															{
																$ch_pprec .= "&nom=" .$nom;
															}
															else if($rech == 'service')
															{
																$ch_pprec .= "&service=" .$service;	
																															
															}
															else if($rech == 'type')
															{
																$ch_pprec .= "&type=" .$type;	
																															
															}
																														
															$ch_pprec .= '" class="lien_blanc"><< page prec</a>';
														
															if($page > 1)						
																echo $ch_pprec;
														
														?>
													
													</td>
													<td class="cell_pied_tabm">
													
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
																	$ch_page .= '<a href="liste_utilisateur.php?page=' .$i;
																	
																	if($rech == 'nom')
																	{
																		$ch_page .= "&nom=" .$nom;
																	}
																	else if($rech == 'service')
																	{
																		$ch_page .= "&service=" .$service;	
																																	
																	}
																	else if($rech == 'type')
																	{
																		$ch_page .= "&type=" .$type;	
																																	
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
															$ch_psuiv = '<a href="liste_utilisateur.php?page=' .$ps;
															
															if($rech == 'nom')
															{
																$ch_psuiv .= "&nom=" .$nom;
															}
															else if($rech == 'service')
															{
																$ch_psuiv .= "&service=" .$service;	
																															
															}
															else if($rech == 'type')
															{
																$ch_psuiv .= "&type=" .$type;	
																															
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
										<td class="cell_type_util">Type</td>
										<td class="cell_service_util">Service</td>
										<td class="cell_nom_util">Nom</td>
										<td class="cell_prenom_util">Prenom</td>
										<td class="cell_login_util">Login</td>
									</tr>
									
					<?php
									
									$blanc = true;
									
									while($utilisateur = mysql_fetch_array($res_util))
									{
										$sql_type = "SELECT * FROM TYPE_UTIL WHERE ID_TYPE_UTIL = " .$utilisateur['ID_TYPE_UTIL'] .";";
										$res_t = mysql_query($sql_type);
										$type = mysql_fetch_array($res_t);
										
										
										$sql_serv = "SELECT * FROM SERVICE WHERE ID_SERVICE = '" .$utilisateur['ID_SERVICE'] ."';";
										$res_s = mysql_query($sql_serv);
										$service = mysql_fetch_array($res_s);
																													
										if($blanc)
										{
																			
											
					?>
											<tr>
												<td class="cell_tab_blanche"><a href="afficher_utilisateur.php?num_util=<?php echo $utilisateur['ID_UTILISATEUR']; ?>"><?php echo $type['LIBELLE_TYPE_UTIL']; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_utilisateur.php?num_util=<?php echo $utilisateur['ID_UTILISATEUR']; ?>"><?php echo $service['ID_SERVICE']; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_utilisateur.php?num_util=<?php echo $utilisateur['ID_UTILISATEUR']; ?>"><?php echo $utilisateur['NOM_UTILISATEUR']; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_utilisateur.php?num_util=<?php echo $utilisateur['ID_UTILISATEUR']; ?>"><?php echo $utilisateur['PRENOM_UTILISATEUR']; ?></a></td>
												<td class="cell_tab_blanche"><a href="afficher_utilisateur.php?num_util=<?php echo $utilisateur['ID_UTILISATEUR']; ?>"><?php echo $utilisateur['LOGIN_UTILISATEUR']; ?></a></td>
																							
											</tr>
									
					
					
					<?php
											
											$blanc = false;
											
										}
										else
										{
										
					?>
					
											<tr>
												<td class="cell_tab_bleu"><a href="afficher_utilisateur.php?num_util=<?php echo $utilisateur['ID_UTILISATEUR']; ?>"><?php echo $type['LIBELLE_TYPE_UTIL']; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_utilisateur.php?num_util=<?php echo $utilisateur['ID_UTILISATEUR']; ?>"><?php echo $service['ID_SERVICE']; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_utilisateur.php?num_util=<?php echo $utilisateur['ID_UTILISATEUR']; ?>"><?php echo $utilisateur['NOM_UTILISATEUR']; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_utilisateur.php?num_util=<?php echo $utilisateur['ID_UTILISATEUR']; ?>"><?php echo $utilisateur['PRENOM_UTILISATEUR']; ?></a></td>
												<td class="cell_tab_bleu"><a href="afficher_utilisateur.php?num_util=<?php echo $utilisateur['ID_UTILISATEUR']; ?>"><?php echo $utilisateur['LOGIN_UTILISATEUR']; ?></a></td>
																								
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
														<td  class="cell_pied_tabm">
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