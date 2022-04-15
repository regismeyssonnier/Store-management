<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimer commande</title>
<link rel="stylesheet" type="text/css" href="site.css"/>
</head>

<body>

	<?php
	
		include('connect.php');
	
		if(isset($_GET['num_com']))
		{
			$sql_com = "SELECT * FROM COMMANDE WHERE NUM_COMMANDE = '" .$_GET['num_com'] ."';";
			$res_c = mysql_query($sql_com);
			$commande = mysql_fetch_array($res_c);
			
			echo '<table class="tab_suivi_conso">';
			echo '<tr>';
			echo '<td class="titre_fond_bleu25" colspan="6">Commande</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Num</td><td colspan="5">' .$commande['NUM_COMMANDE'] .'</td>';
			echo '</tr>';
			echo '<tr>';
			$td = split("-", $commande['DATE_COMMANDE']);
			$date = $td[2] ."/" .$td[1] ."/" .$td[0];
			echo '<td>Date</td><td colspan="5">' .$date .'</td>';
			echo '</tr>';
			
			$sql_livr = "SELECT * FROM RECEVOIR WHERE NUM_COMMANDE = '" .$_GET['num_com'] ."';";
			$res_l = mysql_query($sql_livr);
			
			if(mysql_num_rows($res_l) > 0)
			{
				echo '<tr>';
				echo '<td >N°livraison:</td>';
				echo '<td colspan="5">';
				
				$p = true;
				while($livraison = mysql_fetch_array($res_l))
				{
					if($p)
						echo $livraison['NUM_LIVRAISON'];
					else
						echo " - " .$livraison['NUM_LIVRAISON'];
						
					$p = false;
										
				}
				
				echo '</td></tr>';
				
				
			}
			
			echo '<tr>';
			echo '<td class="cell_ref_suivi_conso">Reference</td>';
			echo '<td class="cell_des_suivi_conso_c">Designation</td>';
			echo '<td class="cell_livre_com">Livré</td>';
			echo '<td class="cell_qte_suivi_conso">Qte</td>';
			echo '<td class="cell_pu_suivi_conso">PU</td>';
			echo '<td class="cell_ptot_suivi_conso">Prix Tot</td>';
			echo '</tr>';
			
			$sql_conso = "SELECT * 
						 FROM CONSOMMABLE AS C, CONTENIR AS CO
						 WHERE C.REFERENCE = CO.REFERENCE
						 AND NUM_COMMANDE = '" .$_GET['num_com'] ."';";
			$res_c = mysql_query($sql_conso);
			
			$total = 0;$total_tva = 0;
			while($conso = mysql_fetch_array($res_c))
			{
				echo '<tr>';
				echo '<td>' .$conso['REFERENCE'] .'</td>';
				echo '<td>' .$conso['DESIGNATION'] .'</td>';
				
				$sql_l = "SELECT SUM(QTE_LIVRE)
						  FROM RECEVOIR AS R, LIVRAISON AS L, LIVRER AS LI
						  WHERE R.NUM_COMMANDE = '" .$_GET['num_com'] ."'
						  AND R.NUM_LIVRAISON = L.NUM_LIVRAISON
						  AND L.NUM_LIVRAISON = LI.NUM_LIVRAISON
						  AND REFERENCE = '" .$conso['REFERENCE'] ."'
						  GROUP BY REFERENCE;";
				$res_l = mysql_query($sql_l);
				$nb = mysql_fetch_array($res_l);
				if($nb[0] == '')
					$nb[0] = 0;
				
				echo '<td align="center">' .$nb[0] .'</td>';
				
				echo '<td align="center">' .$conso['QTE_COMMANDER'] .'</td>';
				echo '<td align="center">' .round($conso['PRIX_UNITAIRE'], 2) .'&#8364;</td>';
				echo '<td align="center">' .($conso['QTE_COMMANDER'] * round($conso['PRIX_UNITAIRE'], 2)) .'&#8364;</td>';
				echo '</tr>';
				
				$sql_tva = "SELECT * FROM TVA WHERE CODE_TVA = " .$conso['CODE_TVA'];
				$res_tva = mysql_query($sql_tva);
				$tva = mysql_fetch_array($res_tva);
				
				$total_tva += round((($conso['PRIX_UNITAIRE'] * $conso['QTE_COMMANDER']) * $tva['TAUX_TVA']) / 100, 2);
				$total += ($conso['QTE_COMMANDER'] * round($conso['PRIX_UNITAIRE'], 2));
			
			}
			
			echo '<tr><td colspan="3" align="right" class="cell_total">Total TVA</td><td colspan="3" align="center" class="cell_total_p">' .$total_tva .'&#8364;</td></tr>';
			echo '<tr><td colspan="3" align="right" >Total TTC</td><td colspan="3" align="center" class="cell_total_p">' .$total .'&#8364;</td></tr>';
			
		
		
		
		}
		else
		{
			echo '<center>Aucun numero de commande n a ete fourni a la page.</center>';
		
		}
	
	
	
	
	
	?>



</body>
</html>