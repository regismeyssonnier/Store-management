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
					ARCHIVE - Fiche demande
				</div>
				</center>
			
				<?php
				
					include('connect.php');
					
					if(isset($_GET['num_dem']))
					{
						if(ctype_digit($_GET['num_dem']))
						{
					
							$sql_dem = "SELECT * 
										FROM DEMANDE_ARCHIVE
										WHERE NUM_DEMANDE = " .$_GET['num_dem'] .";";
							$res_d = mysql_query($sql_dem);
							
							if(mysql_num_rows($res_d) > 0)
							{
								$demande = mysql_fetch_array($res_d);
						
					
										
					?>
													
									
								<form action="archive_demande.php" method="post">
								<table class="tab_bleu_575">
									<tr>
										<td class="titre_fond_bleu25" valign="top" colspan="2">
											Fiche demande
										</td>
									</tr>
									<tr>
										<td class="cell_125">Date demande</td>
										<td class="cell_450">
										<?php 
										
											$t_d = split("-", $demande['DATE_DEMANDE']);
											echo $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
										
										?>
										</td>
									</tr>
									<tr>
										<td class="cell_125">Division</td>
										<td class="cell_450">
										<?php 
											
											echo $demande['DIVISION'];
										
										?>
										</td>
									</tr>
									<tr>
										<td class="cell_125">Service</td>
										<td class="cell_450">
										<?php 
											
											echo $demande['SERVICE'];
										
										?>
										</td>
									</tr>
									<tr>
										<td>Etat</td>
										<td>
										<?php
										
											echo 'traitée';
										
										?>
										</td>
									</tr>
									<tr>
										<td class="titre_fond_bleu25" valign="top" colspan="2">
											Consommable de la demande
										</td>
									</tr>
									<tr>
										<td colspan="2">
										<?php
										
											$sql_dem = "SELECT *
														FROM CONSOMMABLE AS C, DEMANDER_ARCHIVE AS DEM
														WHERE C.REFERENCE = DEM.REFERENCE
														AND NUM_DEMANDE = " .$_GET['num_dem'];
											$res_c = mysql_query($sql_dem);
											if(mysql_num_rows($res_c) > 0)
											{
										?>
												<table class="tab_conso_dem">
													<tr>
														<td class="cell_100">Reference</td>
														<td class="cell_400">Designation</td>
														<td class="cell_37_5">Qte</td>
														<td class="cell_37_5">Reçu</td>
													</tr>
										<?php
										
												while($conso = mysql_fetch_array($res_c))
												{
													echo '<tr>';
													echo '<td>' .$conso['REFERENCE'] .'</td>';
													echo '<td>' .$conso['DESIGNATION'] .'</td>';
													echo '<td align="center">' .$conso['QTE_DEMANDER'] .'</td>';
													echo '<td align="center">' .$conso['QTE_DEMANDER'] .'</td>';
													echo '</tr>';		
												
												}
										
										?>
													
												</table>
										<?php
											}
													 
										
										?>
										</td>
									</tr>
									<tr>
										<td class="titre_fond_bleu25" colspan="2">
											
												<input type="submit" name="retour" value="Retour" class="bouton_blanc12" />
											
										</td>
									</tr>
								</table>	
								</form>
								
								
				
				<?php
							}
							else
							{
								echo "<center>Aucunes des demandes n'a se numero.</center>";						
							}
							
						}
						else
						{
							echo "<center>Mauvais numero de demande</center>";
						
						}
				
				
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