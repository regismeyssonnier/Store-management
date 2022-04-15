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
<!--------------------------- EXT JS ------------------------------>
<link rel="stylesheet" type="text/css" href="Ext_JS/resources/css/ext-all.css" />
<script type="text/javascript" src="Ext_JS/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="Ext_JS/ext-all.js"></script>
<!--------------------------- FIN EXT JS ------------------------------>
<script src="saisir_article_livraison.js" type="text/javascript"></script>

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
							LIVRAISON - Saisie livraison
						</div>
						</center>
						
						<!-- Mettre un form qui sert bien placer les claques(pas de decalage en Firefox et Internet Explorer -->
						<form>
						<table class="tab_explication">
							<tr>
								<td class="explication_eff_dem">
									Pour choisir un consommable, il faut tout d'abord choisir le numéro de commande associé à
									la livraison, puis ensuite sélectionner le consommable dans la liste du dessous, puis
									cliquer sur Ajouter le consommable.
								</td>
							<tr>
						</table>
						</form>
						
												
					
						<div id="commande" class="tab_ext_conso">
							
							<div id="conso_type" >
								
							
							</div>
														
													
						</div>
						
						
						
															
						
						<div id="zone_liste_conso" >
						<?php
							
							include('conso_livraison.php');
						
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