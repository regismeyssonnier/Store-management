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
			
				<center>
				<div class="titre_page">
					CONFIGURATION - Fusionner les divisions
				</div>
				</center>
			
				<?php
				
					include('connect.php');
					
					$saisie = true;
					
					if(isset($_POST['fusionner_division']))
					{
						$sql_ser = "SELECT * FROM SERVICE WHERE ID_DIVISION = '" .$_POST['division1'] ."' OR ID_DIVISION = '" .$_POST['division2'] ."';";
						$res_s = mysql_query($sql_ser);
						
						if(mysql_num_rows($res_s) > 0)
						{
							while($service = mysql_fetch_array($res_s))
							{
								$sql_up = "UPDATE SERVICE 
										   SET ID_DIVISION = '" .$_POST['division3'] ."'
										   WHERE ID_SERVICE = '" .$service['ID_SERVICE'] ."';";
								mysql_query($sql_up);
							
									   
							}
						
						}
						
						$sql_ins = "INSERT INTO FUSIONNER VALUES('" .$_POST['division1'] ."', '" .$_POST['division2'] ."', '" .$_POST['division3'] ."', CURDATE());";
						mysql_query($sql_ins);
						
						if($_POST['division1'] != $_POST['division3'])
						{
							$sql_div = "DELETE FROM DIVISION WHERE ID_DIVISION = '" .$_POST['division1'] ."';";
							mysql_query($sql_div);
						}
						
						if($_POST['division2'] != $_POST['division3'])
						{
							$sql_div = "DELETE FROM DIVISION WHERE ID_DIVISION = '" .$_POST['division2'] ."';";
							mysql_query($sql_div);
						}
						
						$saisie = false;
							
					
					}
					
					if($saisie)
					{
				
					
				
				?>
				
						
				
											
						<form action="fusionner_division.php" method="post" id="form_fusionner_division" onsubmit="return Fusionner_division();">
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top" colspan="3">
									Fusionner 2 divisions
								</td>
							</tr>
							<tr>
								<td colspan="3" style="text-align:justify;">
									&nbsp;&nbsp;&nbsp;&nbsp;Pour fusionner 2 divisions, choisir tout d'abord les deux divisions à fusionner
									(Division1 et Division2), puis choisir la nouvelle division apres l'avoir ajoutée(Fusionne en), puis
									cliquer sur Fusionner 2 divisions.
								</td>
							</tr>
							<tr>
								<td class="cell_75_simple">Division 1</td>
								<td class="cell_500_simple" colspan="2" id="zone_div1">
								<?php
						
									include('select_division1.php');
								
								?>
								</td>
							</tr>
							<tr>
								<td class="cell_75_simple">Division 2 </td>
								<td class="cell_500_simple" colspan="2" id="zone_div2">
								<?php
						
									include('select_division2.php');
								
								?>
								</td>
							</tr>
							<tr>
								<td class="cell_75_simple">Fusionne en</td>
								<td class="cell_500_simple" colspan="2" id="zone_div3">
								<?php
						
									include('select_division3.php');
								
								?>
								</td>
							</tr>
							<tr>
								<td class="titre_fond_bleu25" colspan="3"><input type="submit" name="fusionner_division" value="Fusionner 2 division" class="bouton_blanc12" /></td>
							</tr>
						</table>	
						</form>
				
				<?php
				
					}
					else
					{
					
				?>
										
						<form action="fusionner_division.php" method="post">
						<table class="tab_bleu_575">
							<tr>
								<td class="titre_fond_bleu25" valign="top" colspan="3">
									Fusionner 2 divisions
								</td>
							</tr>
							<tr>
								<td align="center">Les divisions ont bien été fusionnées</td>
							</tr>
							<tr>
								<td class="titre_fond_bleu25" colspan="3">
									<input type="submit" name="retour" value="Retour" class="bouton_blanc12" />
								</td>
							</tr>
						</table>	
						</form>
				
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