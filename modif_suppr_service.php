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
				
					
				
				?>
				
					<center>
					<div class="titre_page">
						CONFIGURATION - Modifier supprimer service
					</div>
					</center>
					
					<form action="service.php" method="post" id="form_ajout_service">
					<table class="tab_bleu_575">
						<tr>
							<td class="titre_fond_bleu25" valign="top" colspan="3">
								Choisissez une division
							</td>
						</tr>
						<tr>
							<td class="">Division</td>
							<td class="" colspan="2">
							<?php
					
								$sql_division = "SELECT * FROM DIVISION ORDER BY ID_DIVISION;";
								$res_d = mysql_query($sql_division);
								
								$prem = true;
								$id_division = '';
								echo '<select name="division" id="division" onchange="select_change_division()">';
								while($division = mysql_fetch_array($res_d))
								{
									if($prem)
									{
										$id_division = $division['ID_DIVISION'];
										$prem = false;
									}
									echo '<option value="' .$division['ID_DIVISION'] .'">' .$division['ID_DIVISION'] .'</option>';								
								}
								echo '</select>';
							
							?>
							</td>
						</tr>
						<tr>
							<td class="titre_fond_bleu25" colspan="3"></td>
						</tr>
					</table>	
					</form>
														
					<div id="zone_service">
					<?php
						
						include('service_ajax.php');
						
					?>
					</div>
					
					
				
			</td>
		</tr>
		<tr>
			<td class="cell_pied_page" colspan="2">
			</td>
		</tr>
	</table>









</body>
</html>