<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimer livraison</title>
<link rel="stylesheet" type="text/css" href="site.css"/>
</head>

<body>

	<?php
	
		include('connect.php');
	
		if(isset($_GET['num_livr']))
		{
			$sql_livr = "SELECT * FROM LIVRAISON WHERE NUM_LIVRAISON = '" .$_GET['num_livr'] ."';";
			$res_l = mysql_query($sql_livr);
			$livraison = mysql_fetch_array($res_l);
			
			echo '<table class="tab_suivi_conso">';
			echo '<tr>';
			echo '<td class="titre_fond_bleu25" colspan="5">Livraison</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Num</td><td colspan="4">' .$livraison['NUM_LIVRAISON'] .'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Date</td><td colspan="4">' .$livraison['DATE_LIVRAISON'] .'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td class="cell_ref_suivi_conso">Reference</td>';
			echo '<td class="cell_des_suivi_conso">Designation</td>';
			echo '<td class="cell_qte_suivi_conso">Qte</td>';
			echo '<td class="cell_pu_suivi_conso">PU</td>';
			echo '<td class="cell_ptot_suivi_conso">Prix Tot</td>';
			echo '</tr>';
			
			$sql_conso = "SELECT * 
						 FROM CONSOMMABLE AS C, LIVRER AS L
						 WHERE C.REFERENCE = L.REFERENCE
						 AND NUM_LIVRAISON = '" .$_GET['num_livr'] ."';";
			$res_c = mysql_query($sql_conso);
			
			$total = 0;$total_tva = 0;
			while($conso = mysql_fetch_array($res_c))
			{
				echo '<tr>';
				echo '<td>' .$conso['REFERENCE'] .'</td>';
				echo '<td>' .$conso['DESIGNATION'] .'</td>';
				echo '<td align="center">' .$conso['QTE_LIVRE'] .'</td>';
				echo '<td align="center">' .round($conso['PRIX_UNITAIRE'], 2) .'&#8364;</td>';
				echo '<td align="center">' .($conso['QTE_LIVRE'] * round($conso['PRIX_UNITAIRE'], 2)) .'&#8364;</td>';
				echo '</tr>';
				
				$sql_tva = "SELECT * FROM TVA WHERE CODE_TVA = " .$conso['CODE_TVA'];
				$res_tva = mysql_query($sql_tva);
				$tva = mysql_fetch_array($res_tva);
				
				$total_tva += round((($conso['PRIX_UNITAIRE'] * $conso['QTE_LIVRE']) * $tva['TAUX_TVA']) / 100, 2);
				$total += ($conso['QTE_LIVRE'] * round($conso['PRIX_UNITAIRE'], 2));
			
			}
			
			echo '<tr><td colspan="3" align="right" class="cell_total">Total TVA</td><td colspan="2" align="center" class="cell_total_p">' .$total_tva .'&#8364;</td></tr>';
			echo '<tr><td colspan="3" align="right" >Total TTC</td><td colspan="2" align="center" class="cell_total_p">' .$total .'&#8364;</td></tr>';
			
		
		
		
		}
		else
		{
			echo '<center>Aucun numero de commande n a ete fourni a la page.</center>';
		
		}
	
	
	
	
	
	?>



</body>
</html>