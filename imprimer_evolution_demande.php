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
				$sql_division = "SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 10
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
							     INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
								 WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
								 GROUP BY C.REFERENCE, PRIX_CONSO
								 UNION 
								 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
								 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
								 WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
								 GROUP BY C.REFERENCE, PRIX_CONSO
								 ORDER BY REFERENCE, PRIX_CONSO;";
			
			}
			else
			{
		
				$sql_division = "SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 10
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
							     INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
								 INNER JOIN UTILISATEUR AS U ON D.ID_UTILISATEUR_FAIRE
								 INNER JOIN SERVICE AS S ON U.ID_SERVICE = S.ID_SERVICE
								 WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
								 AND S.ID_DIVISION = '" .$_GET['division'] ."' 
								 GROUP BY C.REFERENCE, PRIX_CONSO
								 UNION 
								 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
								 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
								 WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
								 AND DIVISION = '" .$_GET['division'] ."'
								 GROUP BY C.REFERENCE, PRIX_CONSO
								 ORDER BY REFERENCE, PRIX_CONSO;";
								 
			}
			
							 
			$res_d = mysql_query($sql_division)or die("Erreur division grouper : " .$sql_division);
			
			$tab_ref = array();
			$i = 0;
			$som_qte = 0;
			$ref = '';
			$des = '';
			$pu = '';
			$total = 0;
			$prem = true;
			while($division = mysql_fetch_array($res_d))
			{
				if( (($ref != $division['REFERENCE']) || ( ($ref == $division['REFERENCE']) && ($pu != $division['PRIX_CONSO']) )) && !$prem )
				{
					$tab_ref[$i][0] = $ref;
					$tab_ref[$i][1] = $des;
					$tab_ref[$i][2] = $som_qte;
					$tab_ref[$i][3] = $pu;
					$total += ($som_qte * round($pu, 2));
					$som_qte = 0;
					$i++;
				}
				
				$ref = $division['REFERENCE'];
				$des = $division['REFERENCE'];
				$som_qte += $division[2];
				$pu = $division['PRIX_CONSO'];
				$prem = false;
			
			
			}
			
			$tab_ref[$i][0] = $ref;
			$tab_ref[$i][1] = $des;
			$tab_ref[$i][2] = $som_qte;
			$tab_ref[$i][3] = $pu;
			$total += ($som_qte * round($pu, 2));
						
			echo '<table class="tab_suivi_conso">';
			echo '<tr>';
			$div = 'du ' .$_GET['division'];
			if($_GET['division'] == 'Toute')
				$div = 'de toutes les divisions';
			echo '<td class="titre_fond_bleu25" colspan="5">Evolution de la demande ' .$div .' du ' .$_GET['date1'] .' au ' .$_GET['date2'] .'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td class="cell_ref_suivi_conso">Reference</td>';
			echo '<td class="cell_des_suivi_conso">Designation</td>';
			echo '<td class="cell_qte_suivi_conso">Qte</td>';
			echo '<td class="cell_pu_suivi_conso">PU</td>';
			echo '<td class="cell_ptot_suivi_conso">Prix Tot</td>';
			echo '</tr>';
			
			$n = count($tab_ref);
			for($i = 0;$i < $n;$i++)
			{
				echo '<tr>';
				echo '<td>' .$tab_ref[$i][0] .'</td>';
				echo '<td>' .$tab_ref[$i][1] .'</td>';
				echo '<td align="center">' .$tab_ref[$i][2] .'</td>';
				echo '<td align="center">' .round($tab_ref[$i][3], 2) .'&#8364;</td>';
				echo '<td align="center">' .($tab_ref[$i][2] * round($tab_ref[$i][3], 2)) .'&#8364;</td>';
				echo '</tr>';
							
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
			echo '<td class="titre_fond_bleu25" colspan="5">Evolution de la demande ' .$div .' du ' .$_GET['date1'] .' au ' .$_GET['date2'] .'</td>';
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
			
				$sql_conso    = "SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 10
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
							     INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
								 INNER JOIN UTILISATEUR AS U ON D.ID_UTILISATEUR_FAIRE = U.ID_UTILISATEUR
								 WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
								 AND U.ID_SERVICE = '" .$service['ID_SERVICE'] ."' 
								 GROUP BY C.REFERENCE, PRIX_CONSO
								 UNION 
								 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
								 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
								 WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
								 AND SERVICE = '" .$service['ID_SERVICE'] ."'
								 GROUP BY C.REFERENCE, PRIX_CONSO
								 ORDER BY REFERENCE, PRIX_CONSO;";
							
				$res_c = mysql_query($sql_conso);
				
				$tab_ref = array();
				$i = 0;
				$som_qte = 0;
				$ref = '';
				$des = '';
				$pu = '';
				$total = 0;
				$prem = true;
				while($division = mysql_fetch_array($res_c))
				{
					if( (($ref != $division['REFERENCE']) || ( ($ref == $division['REFERENCE']) && ($pu != $division['PRIX_CONSO']) )) && !$prem )
					{
						$tab_ref[$i][0] = $ref;
						$tab_ref[$i][1] = $des;
						$tab_ref[$i][2] = $som_qte;
						$tab_ref[$i][3] = $pu;
						$total += ($som_qte * round($pu, 2));
						$som_qte = 0;
						$i++;
					}
					
					$ref = $division['REFERENCE'];
					$des = $division['REFERENCE'];
					$som_qte += $division[2];
					$pu = $division['PRIX_CONSO'];
					$prem = false;
				
				
				}
				
				$tab_ref[$i][0] = $ref;
				$tab_ref[$i][1] = $des;
				$tab_ref[$i][2] = $som_qte;
				$tab_ref[$i][3] = $pu;
				$total += ($som_qte * round($pu, 2));
					
				$n = count($tab_ref);
				for($i = 0;$i < $n;$i++)
				{
					echo '<tr>';
					echo '<td>' .$tab_ref[$i][0] .'</td>';
					echo '<td>' .$tab_ref[$i][1] .'</td>';
					echo '<td align="center">' .$tab_ref[$i][2] .'</td>';
					echo '<td align="center">' .round($tab_ref[$i][3], 2) .'&#8364;</td>';
					echo '<td align="center">' .($tab_ref[$i][2] * round($tab_ref[$i][3], 2)) .'&#8364;</td>';
					echo '</tr>';
								
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
		echo '<td class="titre_fond_bleu25" colspan="5">Evolution de la demande du ' .$_GET['service'] .' du ' .$_GET['date1'] .' au ' .$_GET['date2'] .'</td>';
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
	
		$sql_conso    = "SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 10
						 FROM CONSOMMABLE AS C
						 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
						 INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
						 INNER JOIN UTILISATEUR AS U ON D.ID_UTILISATEUR_FAIRE = U.ID_UTILISATEUR
						 WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
						 AND U.ID_SERVICE = '" .$_GET['service'] ."' 
						 GROUP BY C.REFERENCE, PRIX_CONSO
						 UNION 
						 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
						 FROM CONSOMMABLE AS C
						 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
						 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
						 WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
						 AND SERVICE = '" .$_GET['service'] ."'
						 GROUP BY REFERENCE, PRIX_CONSO
						 ORDER BY REFERENCE, PRIX_CONSO;";
			
		$res_c = mysql_query($sql_conso);
		
		$tab_ref = array();
		$i = 0;
		$som_qte = 0;
		$ref = '';
		$des = '';
		$pu = '';
		$total = 0;
		$prem = true;
		while($division = mysql_fetch_array($res_c))
		{
			if( (($ref != $division['REFERENCE']) || ( ($ref == $division['REFERENCE']) && ($pu != $division['PRIX_CONSO']) )) && !$prem )
			{
				$tab_ref[$i][0] = $ref;
				$tab_ref[$i][1] = $des;
				$tab_ref[$i][2] = $som_qte;
				$tab_ref[$i][3] = $pu;
				$total += ($som_qte * round($pu, 2));
				$som_qte = 0;
				$i++;
			}
			
			$ref = $division['REFERENCE'];
			$des = $division['REFERENCE'];
			$som_qte += $division[2];
			$pu = $division['PRIX_CONSO'];
			$prem = false;
		
		
		}
		
		$tab_ref[$i][0] = $ref;
		$tab_ref[$i][1] = $des;
		$tab_ref[$i][2] = $som_qte;
		$tab_ref[$i][3] = $pu;
		$total += ($som_qte * round($pu, 2));
		
		$n = count($tab_ref);
		for($i = 0;$i < $n;$i++)
		{
			echo '<tr>';
			echo '<td>' .$tab_ref[$i][0] .'</td>';
			echo '<td>' .$tab_ref[$i][1] .'</td>';
			echo '<td align="center">' .$tab_ref[$i][2] .'</td>';
			echo '<td align="center">' .round($tab_ref[$i][3], 2) .'&#8364;</td>';
			echo '<td align="center">' .($tab_ref[$i][2] * round($tab_ref[$i][3], 2)) .'&#8364;</td>';
			echo '</tr>';
						
		}
		
		echo '<tr><td colspan="3" align="right" class="cell_total">Total</td><td colspan="2" align="center" class="cell_total_p">' .$total .'&#8364;</td></tr>';
		
		echo '</table>';
		
	
	}


?>

</body>
</html>
	
	
	

