<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimer suivi de consommation</title>
<link rel="stylesheet" type="text/css" href="site.css"/>
</head>

<body>


<?php

	include('connect.php');
	
		
	if(isset($_GET['division']) && isset($_GET['choix_div']))
	{
		if($_GET['choix_div'] == 'grouper')
		{
			$t_d1 = split("/", $_GET['date1']);
			$t_d2 = split("/", $_GET['date2']);
			
			$date1 = $t_d1[2] ."-" .$t_d1[1] ."-" .$t_d1[0];
			$date2 = $t_d2[2] ."-" .$t_d2[1] ."-" .$t_d2[0];
			
			if($_GET['division'] == 'Toute')
			{
				$sql_division = "SELECT C.REFERENCE, DESIGNATION, SUM(NB_CONSO), PRIX_CONSO
								 FROM CONSOMMABLE AS C, CONSOMMER AS CO
								 WHERE DATE_CONSO BETWEEN '" .$date1 ."' AND '" .$date2 ."' 
								 AND C.REFERENCE = CO.REFERENCE
								 GROUP BY C.REFERENCE, PRIX_CONSO 
								 HAVING SUM(NB_CONSO) > 0;";
			
			}
			else
			{
		
				$sql_division = "SELECT C.REFERENCE, DESIGNATION, SUM(NB_CONSO), PRIX_CONSO
								 FROM CONSOMMABLE AS C, CONSOMMER AS CO, SERVICE AS S, DIVISION AS D
								 WHERE DATE_CONSO BETWEEN '" .$date1 ."' AND '" .$date2 ."' 
								 AND C.REFERENCE = CO.REFERENCE
								 AND CO.ID_SERVICE = S.ID_SERVICE
								 AND S.ID_DIVISION = D.ID_DIVISION
								 AND D.ID_DIVISION = '" .$_GET['division'] ."' "
							   ."GROUP BY C.REFERENCE, PRIX_CONSO 
								 HAVING SUM(NB_CONSO) > 0;";
								 
			}
			
							 
			$res_d = mysql_query($sql_division)or die("Erreur division grouper : " .$sql_division);
						
			echo '<table class="tab_suivi_conso">';
			echo '<tr>';
			$div = 'du ' .$_GET['division'];
			if($_GET['division'] == 'Toute')
				$div = 'de toutes les divisions';
			echo '<td class="titre_fond_bleu25" colspan="5">Suivi de consommation ' .$div .' du ' .$_GET['date1'] .' au ' .$_GET['date2'] .'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td class="cell_ref_suivi_conso">Reference</td>';
			echo '<td class="cell_des_suivi_conso">Designation</td>';
			echo '<td class="cell_qte_suivi_conso">Qte</td>';
			echo '<td class="cell_pu_suivi_conso">PU</td>';
			echo '<td class="cell_ptot_suivi_conso">Prix Tot</td>';
			echo '</tr>';
			
			$total = 0;
			while($division = mysql_fetch_array($res_d))
			{
				echo '<tr>';
				echo '<td>' .$division[0] .'</td>';
				echo '<td>' .$division[1] .'</td>';
				echo '<td align="center">' .$division[2] .'</td>';
				echo '<td align="center">' .round($division[3], 2) .'&#8364;</td>';
				echo '<td align="center">' .($division[2] * round($division[3], 2)) .'&#8364;</td>';
				echo '</tr>';
				$total += ($division[2] * round($division[3], 2));
			
			}
			
			echo '<tr><td colspan="3" align="right" class="cell_total">Total</td><td colspan="2" align="center" class="cell_total_p">' .$total .'&#8364;</td></tr>';
			
			
			echo '</table>';
			
		}
		else
		{
			echo '<table class="tab_suivi_conso">';
			echo '<tr>';
			$div = 'du ' .$_GET['division'];
			if($_GET['division'] == 'Toute')
				$div = 'de toutes les divisions';
			echo '<td class="titre_fond_bleu25" colspan="5">Suivi de consommation ' .$div .' du ' .$_GET['date1'] .' au ' .$_GET['date2'] .'</td>';
			echo '</tr>';
			
			if($_GET['division'] == 'Toute')
				$sql_service = "SELECT * FROM SERVICE;";
			else
				$sql_service = "SELECT * FROM SERVICE WHERE ID_DIVISION = '" .$_GET['division'] ."';";
				
			$res_s = mysql_query($sql_service);
			
			while($service = mysql_fetch_array($res_s))
			{
				echo '<tr>';
				echo '<td class="titre_fond_bleuclairfonce" colspan="5">' .$service['ID_SERVICE'] .'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td class="cell_ref_suivi_conso">Reference</td>';
				echo '<td class="cell_des_suivi_conso">Designation</td>';
				echo '<td class="cell_qte_suivi_conso">Qte</td>';
				echo '<td class="cell_pu_suivi_conso">PU</td>';
				echo '<td class="cell_ptot_suivi_conso">Prix Tot</td>';
				echo '</tr>';
				
				$t_d1 = split("/", $_GET['date1']);
				$t_d2 = split("/", $_GET['date2']);
				
				$date1 = $t_d1[2] ."-" .$t_d1[1] ."-" .$t_d1[0];
				$date2 = $t_d2[2] ."-" .$t_d2[1] ."-" .$t_d2[0];
			
				$sql_conso = "SELECT C.REFERENCE, DESIGNATION, SUM(NB_CONSO), PRIX_CONSO
							  FROM CONSOMMABLE AS C, CONSOMMER AS CO
							  WHERE DATE_CONSO BETWEEN '" .$date1 ."' AND '" .$date2 ."' 
							  AND C.REFERENCE = CO.REFERENCE
							  AND CO.ID_SERVICE = '" .$service['ID_SERVICE'] ."' "
							."GROUP BY C.REFERENCE, PRIX_CONSO
							  HAVING SUM(NB_CONSO) > 0;";
							
				$res_c = mysql_query($sql_conso);
				
				$total = 0;
				while($conso = mysql_fetch_array($res_c))
				{
					echo '<tr>';
					echo '<td>' .$conso[0] .'</td>';
					echo '<td>' .$conso[1] .'</td>';
					echo '<td align="center">' .$conso[2] .'</td>';
					echo '<td align="center">' .round($conso[3], 2) .'&#8364;</td>';
					echo '<td align="center">' .($conso[2] * round($conso[3], 2)) .'&#8364;</td>';
					echo '</tr>';
					$total += ($conso[2] * round($conso[3], 2));
				
				}
				
				echo '<tr><td colspan="3" align="right" class="cell_total">Total</td><td colspan="2" align="center" class="cell_total_p">' .$total .'&#8364;</td></tr>';
				
			
			}
			
			echo '</table>';
			
			
		}
	
	
	}
	else if(isset($_GET['service']))
	{
		echo '<table class="tab_suivi_conso">';
		echo '<tr>';
		echo '<td class="titre_fond_bleu25" colspan="5">Suivi de consommation du ' .$_GET['service'] .' du ' .$_GET['date1'] .' au ' .$_GET['date2'] .'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="cell_ref_suivi_conso">Reference</td>';
		echo '<td class="cell_des_suivi_conso">Designation</td>';
		echo '<td class="cell_qte_suivi_conso">Qte</td>';
		echo '<td class="cell_pu_suivi_conso">PU</td>';
		echo '<td class="cell_ptot_suivi_conso">Prix Tot</td>';
		echo '</tr>';
		
		$t_d1 = split("/", $_GET['date1']);
		$t_d2 = split("/", $_GET['date2']);
		
		$date1 = $t_d1[2] ."-" .$t_d1[1] ."-" .$t_d1[0];
		$date2 = $t_d2[2] ."-" .$t_d2[1] ."-" .$t_d2[0];
	
		$sql_conso = "SELECT C.REFERENCE, DESIGNATION, SUM(NB_CONSO), PRIX_CONSO
					  FROM CONSOMMABLE AS C, CONSOMMER AS CO
					  WHERE DATE_CONSO BETWEEN '" .$date1 ."' AND '" .$date2 ."' 
					  AND C.REFERENCE = CO.REFERENCE
					  AND CO.ID_SERVICE = '" .$_GET['service'] ."' "
					."GROUP BY C.REFERENCE, PRIX_CONSO 
					  HAVING SUM(NB_CONSO) > 0;";
			
		$res_c = mysql_query($sql_conso);
		
		$total = 0;
		while($conso = mysql_fetch_array($res_c))
		{
			echo '<tr>';
			echo '<td>' .$conso[0] .'</td>';
			echo '<td>' .$conso[1] .'</td>';
			echo '<td align="center">' .$conso[2] .'</td>';
			echo '<td align="center">' .round($conso[3], 2) .'&#8364;</td>';
			echo '<td align="center">' .($conso[2] * round($conso[3], 2)) .'&#8364;</td>';
			echo '</tr>';
			$total += ($conso[2] * round($conso[3], 2));
		
		}
		
		echo '<tr><td colspan="3" align="right" class="cell_total">Total</td><td colspan="2" align="center" class="cell_total_p">' .$total .'&#8364;</td></tr>';
		
		echo '</table>';
		
		
	
	}


?>

</body>
</html>
	
	
	

