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
					GESTION CONSO - Coût d'achat
				</div>
				</center>
			
				<fieldset class="field_rech">
					<legend class="legend_rech">Coût d'achat:</legend>
					<table class="tab_rechercher">
						<form action="" id="form_per_cout_achat">
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Choisissez la période (ex: Du 01/01/2009 au 31/12/2009)
							</td>
						</tr>
						<tr>
							<td>Période :</td>
							<td>
								Du <input type="text" name="date1" id="date1" value="01/01/<?php echo date('Y'); ?>" size="10" maxlength="10" />
								au <input type="text" name="date2" id="date2" value="<?php echo date('d') ."/" .date('m') ."/" .date('Y'); ?>" size="10" maxlength="10" />
							</td>
							<td></td>
						</tr>
						</form>
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Division
							</td>
						</tr>
						<tr>
							<td>Division :</td>
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
								<input type="button" name="rech_division" value="Rechercher" onclick="Cout_achat_division();"/>
							</td>
						</tr>
						<tr>
							<td>Choix :</td>
							<td>
								<select name="choix_div" id="choix_div">
									<option value="grouper">grouper</option>
									<option value="par_service">par service</option>
								</select>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="3" class="titre_fond_bleuclairfonce">
								Service
							</td>
						</tr>
						<tr>
							<td>Service :</td>
							<td id="zone_sel_service">
							<?php
							
								include('select_service_impr.php');
							
							?>
							</td>
							<td align="right">
								<input type="button" name="rech_service" value="Rechercher" onclick="Cout_achat_service();"/>
							</td>
						</tr>
						
					</table>
				</fieldset>
				
				<div id="cout_achat">
			
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