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
								 AND D.ID_DIVISION = '" .$_POST['division'] ."' "
							   ."GROUP BY C.REFERENCE, PRIX_CONSO 
								 HAVING SUM(NB_CONSO) > 0;";
								 
			}
							 
							 
			$res_d = mysql_query($sql_division)or die("Erreur division grouper : " .$sql_division);
			
			
						
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
	?>
	
			<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso('imprimer_suivi_conso.php?division=<?php echo $_POST['division']; ?>&choix_div=<?php echo $_POST['choix_div']; ?>&date1=<?php echo $_POST['date1']; ?>&date2=<?php echo $_POST['date2']; ?>');">
				<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
			</div>
	
	
	<?php
	
			if(mysql_num_rows($res_d) > 0)
			{
			
	?>
	
				<table class="tab_explication">
					<tr>
						<td class="explication_eff_dem">
							Si vous cliquez sur une des barres du diagramme de suivi de consommation représentant les mois,
							vous pourrez voir en dessus la consommation du mois par article ou par service.
						</td>
					<tr>
				</table>
	
	<?php
				echo '<div id="zone_diag_conso">';
				include('diagramme_suivi_conso.php');				
				echo '</div>';
				
				echo '<div id="zone_cam_conso"></div>';
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
					$s_conso = true;
				
				}
				
				echo '<tr><td colspan="3" align="right" class="cell_total">Total</td><td colspan="2" align="center" class="cell_total_p">' .$total .'&#8364;</td></tr>';
				
			
			}
			
			echo '</table>';
			
	?>
	
			<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso('imprimer_suivi_conso.php?division=<?php echo $_POST['division']; ?>&choix_div=<?php echo $_POST['choix_div']; ?>&date1=<?php echo $_POST['date1']; ?>&date2=<?php echo $_POST['date2']; ?>');">
				<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
			</div>
	
	
	<?php
		
			
			if($s_conso)
			{
	?>
	
				<table class="tab_explication">
					<tr>
						<td class="explication_eff_dem">
							Si vous cliquez sur une des barres du diagramme de suivi de consommation représentant les mois,
							vous pourrez voir en dessus la consommation du mois par article ou par service.
						</td>
					<tr>
				</table>
	
	<?php
				echo '<div id="zone_diag_conso">';
				include('diagramme_suivi_conso.php');				
				echo '</div>';
				
				echo '<div id="zone_cam_conso"></div>';
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
	
		$sql_conso = "SELECT C.REFERENCE, DESIGNATION, SUM(NB_CONSO), PRIX_CONSO
					  FROM CONSOMMABLE AS C, CONSOMMER AS CO
					  WHERE DATE_CONSO BETWEEN '" .$date1 ."' AND '" .$date2 ."' 
					  AND C.REFERENCE = CO.REFERENCE
					  AND CO.ID_SERVICE = '" .$_POST['service'] ."' "
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
		
	?>
	
		<div id="impr_lien" class="imprimer_lien"  onmouseover="Souligne('impr_lien');" onmouseout="DeSouligne('impr_lien');" onclick="Fenetre_imprimer_conso('imprimer_suivi_conso.php?service=<?php echo $_POST['service']; ?>&date1=<?php echo $_POST['date1']; ?>&date2=<?php echo $_POST['date2']; ?>');">
			<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
		</div>
	
	<?php
	
		if(mysql_num_rows($res_c) > 0)
		{
		
	?>

			<table class="tab_explication">
				<tr>
					<td class="explication_eff_dem">
						Si vous cliquez sur une des barres du diagramme de suivi de consommation représentant les mois,
						vous pourrez voir en dessus la consommation du mois par article ou par service.
					</td>
				<tr>
			</table>
	
	<?php
			echo '<div id="zone_diag_conso">';
			include('diagramme_suivi_conso.php');				
			echo '</div>';
			
			echo '<div id="zone_cam_conso"></div>';
		}
		
	
	}


?>

	
	
	
	

