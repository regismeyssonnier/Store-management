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
<!--------------------------- EXT JS ------------------------------>
<link rel="stylesheet" type="text/css" href="Ext_JS/resources/css/ext-all.css" />
<script type="text/javascript" src="Ext_JS/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="Ext_JS/ext-all.js"></script>
<!--------------------------- FIN EXT JS ------------------------------>
<script src="saisir_article_dem.js" type="text/javascript"></script>
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
				
					$saisie = true;
					if(isset($_POST['enregistrer']))
					{
						
						
						
					
					}
				
					
				
				?>
						
						<div class="div_cont_ed">
							<div class="div_ajax_ref" id="ajax_ref">
							
							</div>
							<div class="div_ajax_des" id="ajax_des">
							
							</div>
							
							<div class="div_ajax_val" id="ajax_val">
								<center>Validation de la demande en cours</center>
								<img src="Image/wait.gif" alt="Validation de la demande en cours" />
							</div>
							
						</div>
						
						<center>
						<div class="titre_page">
							DEMANDE - Saisie demande
						</div>
						</center>
						
						<!-- Mettre un form qui sert bien placer les claques(pas de decalage en Firefox et Internet Explorer -->
						<form>
						<table class="tab_explication">
							<tr>
								<td class="explication_eff_dem">
									Pour effectuer une demande, il faut tout d'abord choisir le consommable.<br/>
									-Vous pouvez choisir le consommable en fonction de son type en cliquant sur l'onglet Type, puis selectionner dessous dans la liste
									deroulante le consommable voulu.<br/>
									-On peut aussi choisir le consommable en fonction de l'imprimante sur laquelle il va en cliquant sur l'onglet Imprimante, en selectionnant
									d'abord l'imprimante dans la liste puis en selectionnant le consommable dans la liste du dessous.<br/>
									-Vous pouvez aussi choisir le consommable en tapant sa reference ou sa designation en cliquant sur l'onglet Reference.
									Lorsque vous taperez les premieres de la reference ou de la designation, une fenetre apparaitra
									et vous pourrez ainsi choisir le consommable voulu dans cette liste ou cliquer sur le consommable et le faire glisser sur le 
									tableau nomm&eacute; Consommable de votre demande.<br/>
									Ensuite, il suffit de cliquer sur le bouton Ajouter un consommable pour l'ajouter à votre demande.
								</td>
							<tr>
						</table>
						</form>
						
						<div id="demande" class="tab_ext_conso">
							<div id="tab_conso" >
								<div id="conso_type" >
									
								
								</div>
								<div id="conso_impr" >
								
								</div>
								<div id="conso_ref_des" >
								
								</div>
							</div>
													
						</div>
			
								
						
						
						<div id="zone_liste_conso">
						<?php
							
							include('eff_dem_liste_conso.php');
						
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