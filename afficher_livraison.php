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
<script src="saisir_article_livraison_modif.js" type="text/javascript"></script>

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
				
					if(isset($_GET['num_livr']))
					{
						if($_GET['num_livr'] != '')
						{
						
							$sql_livr = "SELECT * FROM LIVRAISON WHERE NUM_LIVRAISON = '" .addslashes($_GET['num_livr']) ."';";
							$res_l = mysql_query($sql_livr);
														
							if(mysql_num_rows($res_l) > 0)
							{
							
								$livraison = mysql_fetch_array($res_l);
								$date = '';
								$t_d = split('-', $livraison['DATE_LIVRAISON']);
								$date = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
								
								echo '<input type="hidden" name="num_livrh" value="' .$_GET['num_livr'] .'" id="num_livrh"/>';
								echo '<input type="hidden" name="date_livrh" value="' .$date .'" id="date_livrh" />';
								
								$sql_rec = "SELECT * FROM RECEVOIR WHERE NUM_LIVRAISON = '" .$_GET['num_livr'] ."';";
								$res_r = mysql_query($sql_rec);
								$num_c_l = mysql_fetch_array($res_r);
								
								echo '<input type="hidden" name="num_com_livrh" value="' .$num_c_l['NUM_COMMANDE'] .'" id="num_com_livrh" />';
					
				?>
						
							<center>
							<div class="titre_page">
								LIVRAISON - Livraison <?php echo $livraison['NUM_LIVRAISON']; ?>
							</div>
							</center>
														
							<!-- Mettre un form qui sert bien placer les claques(pas de decalage en Firefox et Internet Explorer -->
							<form>
							<table class="tab_explication">
								<tr>
									<td class="explication_eff_dem">
										
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
								
								include('conso_livraison_modif.php');
							
							?>
							</div>
							
							<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso('imprimer_livraison.php?num_livr=<?php echo $_GET['num_livr']; ?>');">
								<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
							</div>
						
						
				<?php
							}
							else
							{
								echo "<center>Aucune livraison n'a ce numero.</center>";						
							}
				
						}
						else
						{
							echo "<center>Aucune numero de livraison n'a ete fournis a la page.</center>";						
						}
						
					}
					else
					{
						echo "<center>Aucun numero de livraison</center>";
					
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