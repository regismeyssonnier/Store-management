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
					
					if(isset($_POST['suppr_division']))
					{
						$sql_del = "DELETE FROM DIVISION_ARCHIVE WHERE ID_DIVISION = '" .$_POST['division'] ."';";
						mysql_query($sql_del)or die($sql_del);
						
					}
				
					
				
				?>
			
					<center>
					<div class="titre_page">
						ARCHIVE - Supprimer division archive
					</div>
					</center>
					
					<form action="suppr_archive_division.php" method="post">
					<table class="tab_bleu_575">
						<tr>
							<td class="titre_fond_bleu25" valign="top" colspan="3">
								Choisir une division à supprimer
							</td>
						</tr>
						<tr>
							<td class="cell_75_simple">Division</td>
							<td class="cell_500_simple" colspan="2" id="zone_div_a">
							<?php
					
								include('select_divisiona.php');
							
							?>
							</td>
						</tr>
						<tr>
							<td class="titre_fond_bleu25" colspan="3">
								<input type="submit" name="aff_division" value="Afficher division" class="bouton_blanc12"/>
								
							</td>
						</tr>
					</table>	
					</form>
					
					
				<?php
				
					if(isset($_POST['aff_division']))
					{
				
				?>
						
						<form action="suppr_archive_division.php" method="post" id="form_suppr_archive_div" onsubmit="return Supprimer_division_archive();">
						<input type="hidden" name="division" value="<?php echo $_POST['divisiona']; ?>" />
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top" colspan="3">
									<?php echo "DIVISION " .$_POST['divisiona']; ?>
								</td>
							</tr>
							<tr>
								<td>
								<?php
								
									$sql_da = "SELECT * FROM DIVISION_ARCHIVE WHERE ID_DIVISION = '" .$_POST['divisiona'] ."';";
									$res_da = mysql_query($sql_da);
									$div_a = mysql_fetch_array($res_da);
									
									$t_d = split("-", $div_a['DATE_ARCHIVE_DIV']);
									$date_arc = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
									
									echo "La division " .$div_a['ID_DIVISION'] ." est la division " .$div_a['NOM_DIVISION'] ." archivée le " .$date_arc .".<br/>";
									if($div_a['ID_DIVISION_PARENT'] != '')
										echo "Cette division était anciennement le " .$div_a['ID_DIVISION_PARENT'] .'<br/>';
										
									$sql_p = "SELECT * FROM DIVISION_ARCHIVE WHERE ID_DIVISION_PARENT = '" .$div_a['ID_DIVISION'] ."';";
									$res_p = mysql_query($sql_p);
									
									if(mysql_num_rows($res_p) > 0)
									{
										$div_p = mysql_fetch_array($res_p);
										
										$t_d = split("-", $div_p['DATE_ARCHIVE_DIV']);
										$date_p = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
									
										echo "Cette division est devenu le " .$div_p['ID_DIVISION'] ." le " .$date_p.'<br/>';
									}
									
									
									$sql_fus = "SELECT * FROM FUSIONNER WHERE ID_DIVISION_FUSION = '" .$_POST['divisiona'] ."';";
									$res_f = mysql_query($sql_fus);
									
									if(mysql_num_rows($res_f) > 0)
									{
										$division = mysql_fetch_array($res_f);
										
										$t_d = split("-", $division['DATE_FUSION']);
										$date_fus = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
																	
										echo "La division " .$_POST['divisiona'] ." est le résultat de la fusion de la division " .$division['ID_DIVISION'] ." et de la division " .$division['ID_DIVISION2'] ." le " .$date_fus ."<br/>";
										
									
									}
								
									$sql_div = "SELECT * FROM FUSIONNER WHERE ID_DIVISION = '" .$_POST['divisiona'] ."' OR ID_DIVISION2 = '" .$_POST['divisiona'] ."';";
									$res_d = mysql_query($sql_div);
									
									if(mysql_num_rows($res_d) > 0)
									{
										$division = mysql_fetch_array($res_d);
										echo "La division " .$_POST['divisiona'] ." a fusionné avec la division ";
										if($division['ID_DIVISION'] != $_POST['divisiona'])
											echo $division['ID_DIVISION'];
										else if($division['ID_DIVISION2'] != $_POST['divisiona'])
											echo $division['ID_DIVISION2'];
											
										$t_d = split("-", $division['DATE_FUSION']);
										$date_fus = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
											
										echo " pour donner la division " .$division['ID_DIVISION_FUSION'] ." le " .$date_fus ."<br/>";
									
									}
									
									$sql_ser = "SELECT * FROM SERVICE WHERE ID_DIVISION = '" .$_POST['divisiona'] ."';";
									$res_s = mysql_query($sql_ser);
									
									if(mysql_num_rows($res_s) > 0)
									{
										echo "Cette division posséde les services suivants: <br/>";
										while($service = mysql_fetch_array($res_s))
										{
											echo " - " .$service['ID_SERVICE'] ."<br/>";
										}
										
									}
									
									
								?>
								</td>
							</tr>
							<tr>
								<td class="titre_fond_bleu25" colspan="3">
									<input type="submit" name="suppr_division" value="Supprimer la division des archives" class="bouton_blanc12"/>
								
								</td>
							</tr>
						</table>	
						</form>

						
				
				<?php
				
					}
					else if(isset($_POST['suppr_division']))
					{
										
				?>
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top" colspan="3">
									Suprimer une division des archives
								</td>
							</tr>
							<tr>
								<td align="center">La division a bien été supprimée des archives</td>
							</tr>
						</table>
					
				
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