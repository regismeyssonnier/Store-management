<?php
	
	header('Content-Type: text/html; charset=ISO-8859-1'); 
	include('connect.php');
	
	$choix = '';
		
	if(isset($_POST['division']))
	{
		if($_POST['choix_div'] == 'grouper')
		{
			$choix = 'division';
		
			$t_d1 = split("/", $_POST['date1']);
			$t_d2 = split("/", $_POST['date2']);
			
			$date1 = $t_d1[2] ."-" .$t_d1[1] ."-" .$t_d1[0];
			$date2 = $t_d2[2] ."-" .$t_d2[1] ."-" .$t_d2[0];
			
			if($_POST['division'] == 'Toute')
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
								 AND S.ID_DIVISION = '" .$_POST['division'] ."' 
								 GROUP BY C.REFERENCE, PRIX_CONSO
								 UNION 
								 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
								 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
								 WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
								 AND DIVISION = '" .$_POST['division'] ."'
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
			echo '<td class="titre_fond_bleu25" colspan="5">' .$_POST['division'] .'</td>';
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
	?>
	
			<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso('imprimer_evolution_demande.php?division=<?php echo $_POST['division']; ?>&choix_div=<?php echo $_POST['choix_div']; ?>&date1=<?php echo $_POST['date1']; ?>&date2=<?php echo $_POST['date2']; ?>');">
				<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
			</div>
	
	
	<?php
	
			if(mysql_num_rows($res_d) > 0)
			{
			
	?>
	
				<table class="tab_explication">
					<tr>
						<td class="explication_eff_dem">
							Si vous cliquez sur une des barres du diagramme d'évolution de la demande représentant les mois,
							vous pourrez voir en dessus la consommation du mois par article ou par service.
						</td>
					<tr>
				</table>
	
	<?php
				echo '<div id="zone_diag_conso">';
				include('diagramme_evolution_dem.php');				
				echo '</div>';
				
				echo '<div id="zone_cam"></div>';
			}
		
		}
		else
		{
			$choix = 'division_service';
			$s_conso = false;
			
			echo '<table class="tab_suivi_conso">';
			echo '<tr>';
			echo '<td class="titre_fond_bleu25" colspan="5">' .$_POST['division'] .'</td>';
			echo '</tr>';
		
			if($_POST['division'] == 'Toute')
				$sql_service = "SELECT * FROM SERVICE;";
			else
				$sql_service = "SELECT * FROM SERVICE WHERE ID_DIVISION = '" .$_POST['division'] ."';";
						
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
				
				$t_d1 = split("/", $_POST['date1']);
				$t_d2 = split("/", $_POST['date2']);
				
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
																		  
				$res_c = mysql_query($sql_conso)or die($sql_conso);
				
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
				
				$s_conso = true;
			
			}
			
			echo '</table>';
			
	?>
	
			<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso('imprimer_evolution_demande.php?division=<?php echo $_POST['division']; ?>&choix_div=<?php echo $_POST['choix_div']; ?>&date1=<?php echo $_POST['date1']; ?>&date2=<?php echo $_POST['date2']; ?>');">
				<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
			</div>
	
	
	<?php
		
			
			if($s_conso)
			{
	?>
	
				<table class="tab_explication">
					<tr>
						<td class="explication_eff_dem">
							Si vous cliquez sur une des barres du diagramme d'évolution de la demande représentant les mois,
							vous pourrez voir en dessus la consommation du mois par article ou par service.
						</td>
					<tr>
				</table>
	
	<?php
				echo '<div id="zone_diag_conso">';
				include('diagramme_evolution_dem.php');				
				echo '</div>';
				
				echo '<div id="zone_cam"></div>';
			}
		
		
		}
	
	
	}
	else if(isset($_POST['service']))
	{
		$choix = 'service';
		
		echo '<table class="tab_suivi_conso">';
		echo '<tr>';
		echo '<td class="titre_fond_bleu25" colspan="5">' .$_POST['service'] .'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="cell_ref_suivi_conso">Reference</td>';
		echo '<td class="cell_des_suivi_conso">Designation</td>';
		echo '<td class="cell_qte_suivi_conso">Qte</td>';
		echo '<td class="cell_pu_suivi_conso">PU</td>';
		echo '<td class="cell_ptot_suivi_conso">Prix Tot</td>';
		echo '</tr>';
		
		$t_d1 = split("/", $_POST['date1']);
		$t_d2 = split("/", $_POST['date2']);
		
		$date1 = $t_d1[2] ."-" .$t_d1[1] ."-" .$t_d1[0];
		$date2 = $t_d2[2] ."-" .$t_d2[1] ."-" .$t_d2[0];
					   
		$sql_conso    = "SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 10
						 FROM CONSOMMABLE AS C
						 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
						 INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
						 INNER JOIN UTILISATEUR AS U ON D.ID_UTILISATEUR_FAIRE = U.ID_UTILISATEUR
						 WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
						 AND U.ID_SERVICE = '" .$_POST['service'] ."' 
						 GROUP BY C.REFERENCE, PRIX_CONSO
						 UNION 
						 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
						 FROM CONSOMMABLE AS C
						 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
						 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
						 WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
						 AND SERVICE = '" .$_POST['service'] ."'
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
		
	?>
	
		<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso('imprimer_evolution_demande.php?service=<?php echo $_POST['service']; ?>&date1=<?php echo $_POST['date1']; ?>&date2=<?php echo $_POST['date2']; ?>');">
			<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
		</div>
	
	<?php
	
		if(mysql_num_rows($res_c) > 0)
		{
		
	?>

			<table class="tab_explication">
				<tr>
					<td class="explication_eff_dem">
						Si vous cliquez sur une des barres du diagramme d'évolution de la demande représentant les mois,
						vous pourrez voir en dessus la consommation du mois par article ou par service.
					</td>
				<tr>
			</table>
	
	<?php
			echo '<div id="zone_diag_conso">';
			include('diagramme_evolution_dem.php');				
			echo '</div>';
			
			echo '<div id="zone_cam"></div>';
		}
		
	
	}


?>

	
	
	
	

