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
<script src="saisir_article_aff_com.js" type="text/javascript"></script>

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
				
					if(isset($_GET['num_com']))
					{
						if($_GET['num_com'] != '')
						{
						
							$sql_com = "SELECT * FROM COMMANDE WHERE NUM_COMMANDE = '" .addslashes($_GET['num_com']) ."';";
							$res_c = mysql_query($sql_com);
							$commande = mysql_fetch_array($res_c);
							
							$date = '';
							$t_d = split('-', $commande['DATE_COMMANDE']);
							$date = $t_d[2] ."/" .$t_d[1] ."/" .$t_d[0];
							
							echo '<input type="hidden" name="num_comh" value="' .$_GET['num_com'] .'" id="num_comh" />';
							echo '<input type="hidden" name="date_comh" value="' .$date .'" id="date_comh" />';
					
				
				?>
				
							<center>
							<div class="titre_page">
								COMMANDE - Commande <?php echo $commande['NUM_COMMANDE']; ?>
							</div>
							</center>
						
							<div class="div_cont_ed">
								<div class="div_ajax_ref_com" id="ajax_ref">
								
								</div>
								<div class="div_ajax_des_com" id="ajax_des">
								
								</div>
								
								<div class="div_ajax_val_com" id="ajax_val">
									<center>Validation de la demande en cours</center>
									<img src="Image/wait.gif" alt="Validation de la demande en cours" />
								</div>
								
							</div>
							
							<!-- Mettre un form qui sert bien placer les claques(pas de decalage en Firefox et Internet Explorer -->
							<form>
							<table class="tab_explication">
								<tr>
									<td class="explication_eff_dem">
										Pour ajouter un consommable à la commande, il faut tout d'abord choisir le consommable.<br/>
										-Vous pouvez choisir le consommable en fonction de son type en cliquant sur l'onglet Type, puis selectionner dessous dans la liste
										deroulante le consommable voulu.<br/>
										-Vous pouvez aussi choisir le consommable en tapant sa reference ou sa designation en cliquant sur l'onglet Reference.
										Lorsque vous taperez les premieres de la reference ou de la designation, une fenetre apparaitra
										et vous pourrez ainsi choisir le consommable voulu dans cette fenetre, ou bien cliquez sur le consommable choisie
										puis faire glisser celui-ci sur le tableau nomm&eacute; Consommables de votre commande<br/>
										Ensuite, il suffit de cliquer sur le bouton Ajouter un consommable pour l'ajouter à votre commande.
									</td>
								<tr>
							</table>
							</form>
							
													
						
							<div id="commande" class="tab_ext_conso">
								<div id="tab_conso" >
									<div id="conso_type" >
										
									
									</div>
									<div id="conso_ref_des" >
									
									</div>
								</div>
														
							</div>
							
							
							
																
							
							<div id="zone_liste_conso" >
							<?php
								
								include('conso_commande_modif.php');
							
							?>
							</div>
							
							<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso('imprimer_commande.php?num_com=<?php echo $_GET['num_com']; ?>');">
								<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
							</div>
						
						
				<?php
						}
						else
						{
							echo "<center>Aucune numero commande n'a ete fournis a la page.</center>";						
						}
						
					}
					else
					{
						echo "<center>Aucun numero de commande</center>";
					
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