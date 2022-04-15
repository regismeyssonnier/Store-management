<?php

	header('Content-Type: text/html; charset=ISO-8859-1'); 
	include('connect.php');
	
	include('camembert.php');
	
	$ma = split("-", $_POST['val']);
	$mois = $ma[0];
	$annee = $ma[1];
	
	$tab_cam = array();
	$tab_lib = array();
	
	if($_POST['choix'] == 'division')
	{
		if($_POST['division'] == 'Toute')
		{
			if( (@$_POST['sel_som_qte'] == 0) || !isset($_POST['sel_som_qte']) )
			{
				$sql_division = "SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 10
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
								 INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
								 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
								 AND MONTH(DATE_DEMANDE) = " .$mois ."
								 AND YEAR(DATE_DEMANDE) = " .$annee ."
								 GROUP BY C.REFERENCE, PRIX_CONSO
								 UNION 
								 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
								 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
								 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
								 AND MONTH(DATE_DEMANDE) = " .$mois ."
								 AND YEAR(DATE_DEMANDE) = " .$annee ."
								 GROUP BY C.REFERENCE, PRIX_CONSO
								 ORDER BY REFERENCE, PRIX_CONSO;";
				
			}
			else
			{
				$sql_division = "SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 10
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
								 INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
								 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
								 AND MONTH(DATE_DEMANDE) = " .$mois ."
								 AND YEAR(DATE_DEMANDE) = " .$annee ."
								 GROUP BY C.REFERENCE
								 UNION 
								 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
								 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
								 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
								 AND MONTH(DATE_DEMANDE) = " .$mois ."
								 AND YEAR(DATE_DEMANDE) = " .$annee ."
								 GROUP BY C.REFERENCE
								 ORDER BY REFERENCE;";
				
				
			}
								
							 
			
			
		
		}
		else
		{
			if( (@$_POST['sel_som_qte'] == 0) || !isset($_POST['sel_som_qte']) )
			{
		
				$sql_division = "SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 10
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
								 INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
								 INNER JOIN UTILISATEUR AS U ON D.ID_UTILISATEUR_FAIRE
								 INNER JOIN SERVICE AS S ON U.ID_SERVICE = S.ID_SERVICE
								 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
								 AND S.ID_DIVISION = '" .$_POST['division'] ."' 
								 AND MONTH(DATE_DEMANDE) = " .$mois ."
								 AND YEAR(DATE_DEMANDE) = " .$annee ."
								 GROUP BY C.REFERENCE, PRIX_CONSO
								 UNION 
								 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
								 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
								 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1']."' AND '" .$_POST['date2'] ."'
								 AND DIVISION = '" .$_POST['division'] ."'
								 AND MONTH(DATE_DEMANDE) = " .$mois ."
								 AND YEAR(DATE_DEMANDE) = " .$annee ."
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
								 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
								 AND S.ID_DIVISION = '" .$_POST['division'] ."' 
								 AND MONTH(DATE_DEMANDE) = " .$mois ."
								 AND YEAR(DATE_DEMANDE) = " .$annee ."
								 GROUP BY C.REFERENCE
								 UNION 
								 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
								 FROM CONSOMMABLE AS C
								 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
								 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
								 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1']."' AND '" .$_POST['date2'] ."'
								 AND DIVISION = '" .$_POST['division'] ."'
								 AND MONTH(DATE_DEMANDE) = " .$mois ."
								 AND YEAR(DATE_DEMANDE) = " .$annee ."
								 GROUP BY C.REFERENCE
								 ORDER BY REFERENCE;";
			
			
			}
							 
						 
		}
		
								 
		$res_d = mysql_query($sql_division)or die($sql_division);
			
		$i = 0;
		$ref = '';$lib = '';
		$prem = true;
		$somme = 0;
		while($division = mysql_fetch_array($res_d))
		{
			if( ($ref != $division['REFERENCE']) && !$prem)
			{
				$tab_cam[$i] = $somme;
				$tab_lib[$i] = $lib;
				$somme = 0;
				$i++;
			}
			
			$ref = $division['REFERENCE'];
			if( (@$_POST['sel_som_qte'] == 0) || !isset($_POST['sel_som_qte']) )
			{
				$lib = 'Euros ' .$division['REFERENCE'] ." " .$division['DESIGNATION'];
				$somme += $division[2] * $division[3];
			}
			else
			{
				$lib = $division['REFERENCE'] ." " .$division['DESIGNATION'];
				$somme += $division[2];
			}
			$prem = false;
			
		}
		
		$tab_cam[$i] = $somme;
		$tab_lib[$i] = $lib;
					 
	}
	else if($_POST['choix'] == 'division_service')
	{
		if($_POST['division'] == 'Toute')
		{
			
			$sql_division = "SELECT U.ID_SERVICE, C.REFERENCE, SUM( QTE_DEMANDER )*PRIX_CONSO, PRIX_CONSO, 10
							 FROM CONSOMMABLE AS C
							 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
							 INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
							 INNER JOIN UTILISATEUR AS U ON D.ID_UTILISATEUR_FAIRE = U.ID_UTILISATEUR
							 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
							 AND MONTH(DATE_DEMANDE) = " .$mois ."
							 AND YEAR(DATE_DEMANDE) = " .$annee ."
							 GROUP BY U.ID_SERVICE, C.REFERENCE, PRIX_CONSO
							 UNION 
							 SELECT SERVICE, C.REFERENCE, SUM( QTE_DEMANDER )*PRIX_CONSO, PRIX_CONSO, 20
							 FROM CONSOMMABLE AS C
							 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
							 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
							 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
							 AND MONTH(DATE_DEMANDE) = " .$mois ."
							 AND YEAR(DATE_DEMANDE) = " .$annee ."
							 GROUP BY SERVICE, C.REFERENCE, PRIX_CONSO
							 ORDER BY 1, REFERENCE, PRIX_CONSO;";
						
		}
		else
		{
			
			$sql_division = "SELECT U.ID_SERVICE, C.REFERENCE, SUM( QTE_DEMANDER )*PRIX_CONSO, PRIX_CONSO, 10
							 FROM CONSOMMABLE AS C
							 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
							 INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
							 INNER JOIN UTILISATEUR AS U ON D.ID_UTILISATEUR_FAIRE = U.ID_UTILISATEUR
							 INNER JOIN SERVICE AS S ON U.ID_SERVICE = S.ID_SERVICE
							 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
							 AND S.ID_DIVISION = '" .$_POST['division'] ."' 
							 AND MONTH(DATE_DEMANDE) = " .$mois ."
							 AND YEAR(DATE_DEMANDE) = " .$annee ."
							 GROUP BY U.ID_SERVICE, C.REFERENCE, PRIX_CONSO
							 UNION 
							 SELECT SERVICE, C.REFERENCE, SUM( QTE_DEMANDER )*PRIX_CONSO, PRIX_CONSO, 20
							 FROM CONSOMMABLE AS C
							 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
							 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
							 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
							 AND DIVISION = '" .$_POST['division'] ."'
							 AND MONTH(DATE_DEMANDE) = " .$mois ."
							 AND YEAR(DATE_DEMANDE) = " .$annee ."
							 GROUP BY SERVICE, C.REFERENCE, PRIX_CONSO
							 ORDER BY 1, REFERENCE, PRIX_CONSO;";
								 
		}
						 
		$res_d = mysql_query($sql_division)or die($sql_division);
						 
		$i = 0;
		$service = '';
		$prem = true;
		$somme = 0;
		while($division = mysql_fetch_array($res_d))
		{
			if( ($service != $division['ID_SERVICE']) && !$prem)
			{
				$tab_cam[$i] = $somme;
				$tab_lib[$i] = 'Euros ' .$service;
				$somme = 0;
				$i++;
				
			}

			$somme += $division[2];
			$service = $division['ID_SERVICE'];
			$prem = false;
			
			
		}
		
		$tab_cam[$i] = $somme;
		$tab_lib[$i] = 'Euros ' .$service;
	
	
	}
	else if($_POST['choix'] == 'service')
	{
	
		if( (@$_POST['sel_som_qte'] == 0) || !isset($_POST['sel_som_qte']) )
		{
			$sql_service  = "SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 10
							 FROM CONSOMMABLE AS C
							 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
							 INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
							 INNER JOIN UTILISATEUR AS U ON D.ID_UTILISATEUR_FAIRE = U.ID_UTILISATEUR
							 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
							 AND U.ID_SERVICE = '" .$_POST['service'] ."' 
							 AND MONTH(DATE_DEMANDE) = " .$mois ."
							 AND YEAR(DATE_DEMANDE) = " .$annee ."
							 GROUP BY C.REFERENCE, PRIX_CONSO
							 UNION 
							 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
							 FROM CONSOMMABLE AS C
							 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
							 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
							 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
							 AND SERVICE = '" .$_POST['service'] ."'
							 AND MONTH(DATE_DEMANDE) = " .$mois ."
							 AND YEAR(DATE_DEMANDE) = " .$annee ."
							 GROUP BY REFERENCE, PRIX_CONSO
							 ORDER BY REFERENCE, PRIX_CONSO;";
							 
		}
		else
		{
			$sql_service  = "SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 10
							 FROM CONSOMMABLE AS C
							 INNER JOIN DEMANDER AS DEM ON C.REFERENCE = DEM.REFERENCE
							 INNER JOIN DEMANDE AS D ON DEM.NUM_DEMANDE = D.NUM_DEMANDE
							 INNER JOIN UTILISATEUR AS U ON D.ID_UTILISATEUR_FAIRE = U.ID_UTILISATEUR
							 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
							 AND U.ID_SERVICE = '" .$_POST['service'] ."' 
							 AND MONTH(DATE_DEMANDE) = " .$mois ."
							 AND YEAR(DATE_DEMANDE) = " .$annee ."
							 GROUP BY C.REFERENCE
							 UNION 
							 SELECT C.REFERENCE, DESIGNATION, SUM( QTE_DEMANDER ) , PRIX_CONSO, 20
							 FROM CONSOMMABLE AS C
							 INNER JOIN DEMANDER_ARCHIVE AS DEMA ON C.REFERENCE = DEMA.REFERENCE
							 INNER JOIN DEMANDE_ARCHIVE AS DA ON DEMA.NUM_DEMANDE = DA.NUM_DEMANDE
							 WHERE DATE_DEMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."'
							 AND SERVICE = '" .$_POST['service'] ."'
							 AND MONTH(DATE_DEMANDE) = " .$mois ."
							 AND YEAR(DATE_DEMANDE) = " .$annee ."
							 GROUP BY REFERENCE
							 ORDER BY REFERENCE;";
		
		
		}
						 
						 
		$res_s = mysql_query($sql_service);
			
		$i = 0;
		$ref = '';$lib = '';
		$prem = true;
		$somme = 0;
		while($service = mysql_fetch_array($res_s))
		{
			if( ($ref != $service['REFERENCE']) && !$prem)
			{
				$tab_cam[$i] = $somme;
				$tab_lib[$i] = $lib;
				$somme = 0;
				$i++;
			}
			
			$ref = $service['REFERENCE'];
			if( (@$_POST['sel_som_qte'] == 0) || !isset($_POST['sel_som_qte']) )
			{
				$somme += $service[2] * $service[3];
				$lib = 'Euros ' .$service['REFERENCE'] ." " .$service['DESIGNATION'];
			}
			else
			{
				$somme += $service[2];
				$lib = $service['REFERENCE'] ." " .$service['DESIGNATION'];
			}
			
			
			$prem = false;
			
		}
		
		$tab_cam[$i] = $somme;
		$tab_lib[$i] = $lib;
	
	
	}
					 
					 
	//$tab_cam = array(10,20,30,40,20,50,9,20,50,40,10,20,30,40,20,50,9,20,50,40,10,20,30,40,20,50,90,20,50,90,10,20,30,40,20,50,9,20,50,40,10,20,30,40,20,50,9,20,50,40,10,20,30,40,20,50,90,20,50,90,10,20,30,40,20,50,9,20,50,40,10,20,30,40,20,50,9,20,50,40,10,20,30,40,20,50,90,20,50,90,10,20,30,40,20,50,9,20);
	//$tab_cam = array(16000, 1500, 500);//, 500, 500, 500, 2, 10);

	echo '<table class="tab_suivi_conso">';
	echo '<tr>';
	$m = '';
	if($mois < 10)
		$m = "0" .$mois;
		
	if($_POST['choix'] == 'division')
	{
		if($_POST['division'] == 'Toute')
			echo '<td class="titre_fond_bleu25" colspan="6">Evolution de la demande du Rectorat du ' .$m ."/" .$annee .'</td>';
		else
			echo '<td class="titre_fond_bleu25" colspan="6">Evolution de la demande par consommable du ' .$_POST['division'] .' du ' .$m ."/" .$annee .'</td>';
		
	}
	else if($_POST['choix'] == 'division_service')
	{
		if($_POST['division'] == 'Toute')
			echo '<td class="titre_fond_bleu25" colspan="6">Evolution de la demande par service du Rectorat du ' .$m ."/" .$annee .'</td>';
		else
			echo '<td class="titre_fond_bleu25" colspan="6">Evolution de la demande par service du ' .$_POST['division'] .' du ' .$m ."/" .$annee .'</td>';
	
	}
	else if($_POST['choix'] == 'service')
		echo '<td class="titre_fond_bleu25" colspan="6">Evolution de la demande par consommable du ' .$_POST['service'] .' du ' .$m ."/" .$annee .'</td>';
		
	
	echo '</tr>';
	echo '<tr>';
	
	echo '<td class="cell_50">Etat:</td>';
	echo '<td class="cell_75_simple">';
	echo '<select name="etat" id="etat" onchange="Changer_etat_diag();">';
	$tab_etat = array('Normal', 'Ecart�', 'S�lection');
	$ne = count($tab_etat);
	for($i = 0;$i < $ne;$i++)
	{
		if(isset($_POST['etat']))
		{
			if($_POST['etat'] == ($i+1))
				echo '<option value="' .($i+1) .'" selected="selected">' .$tab_etat[$i] .'</option>';
			else
				echo '<option value="' .($i+1) .'">' .$tab_etat[$i] .'</option>';
			
		}
		else
		{
			echo '<option value="' .($i+1) .'">' .$tab_etat[$i] .'</option>';
		}
	
	}
	echo '</select>';
	echo '</td>';
	
	if(@$_POST['etat'] == 3)
		echo '<td class="cell_125_n" id="sel_tr1">S�lection tranche:</td><td class="cell_40_n" id="sel_tr2">';
	else
		echo '<td class="cell_125_c" id="sel_tr1">S�lection tranche:</td><td class="cell_40_c" id="sel_tr2">';
	
	$n = count($tab_cam);
	echo '<select name="selection" id="selection">';
	for($i = 1;$i <= $n;$i++)
	{
		if(isset($_POST['sel_tr']))
		{
			if($_POST['sel_tr'] == $i)
				echo '<option value="' .$i .'" selected="selected">' .$i .'</option>';
			else
				echo '<option value="' .$i .'">' .$i .'</option>';
						
		}
		else
		{
			echo '<option value="' .$i .'">' .$i .'</option>';
		}
	}
	echo '</select>';
	echo '</td>';
	if(($_POST['choix'] == 'division') || ($_POST['choix']  == 'division_service'))
		echo '<td class="cell_100_g"><input type="button" name="Valider" value="Valider" onclick="Camembert_ev_division_etat(\'' .$_POST['date1'] ."', '" .$_POST['date2'] ."', '" .$_POST['division'] ."', '" .$mois ."-" .$annee ."', '" .$_POST['choix'] .'\');" /></td>';
	else if($_POST['choix'] == 'service')
		echo '<td class="cell_100_g"><input type="button" name="Valider" value="Valider" onclick="Camembert_ev_service_etat(\'' .$_POST['date1'] ."', '" .$_POST['date2'] ."', '" .$_POST['service'] ."', '" .$mois ."-" .$annee ."', '" .$_POST['choix'] .'\');" /></td>';
	
	echo '<td class="cell_365"><input type="button" name="zoom" value="ZOOM" style="width:125px;" ';
	if(($_POST['choix'] == 'division') || ($_POST['choix']  == 'division_service'))
		echo 'onclick="Camembert_ev_zoom(\'' .$_POST['date1'] ."', '" .$_POST['date2'] ."', '" .$_POST['division'] ."', '" .$mois ."-" .$annee ."', '" .$_POST['choix'] .'\');"';
	else if($_POST['choix'] == 'service')
		echo 'onclick="Camembert_ev_zoom(\'' .$_POST['date1'] ."', '" .$_POST['date2'] ."', '" .$_POST['service'] ."', '" .$mois ."-" .$annee ."', '" .$_POST['choix'] .'\');"';
	echo '/></td>';
	
	echo '</tr>';	
	if($_POST['choix']  != 'division_service')
	{
		echo '<tr><td>Type : </td><td colspan="5">';
		$tab_som_qte = array('Montant Total', 'Nombre conso');
		echo '<select name="som_qte" id="som_qte">';
		for($i = 0;$i < 2;$i++)
		{
			if(isset($_POST['sel_som_qte']))
			{
				if($_POST['sel_som_qte'] == $i)
					echo '<option value="' .$i .'" selected="selected">' .$tab_som_qte[$i] .'</option>';
				else
					echo '<option value="' .$i .'">' .$tab_som_qte[$i] .'</option>';
							
			}
			else
			{
				echo '<option value="' .$i .'">' .$tab_som_qte[$i] .'</option>';
			}
		}
		
		echo '</select>';
		echo '</td></tr>';
	}
	
	echo '<tr><td colspan="6">';
	
	
	$hauteur_image = 0;
	if(isset($_POST['zoom']))
	{
		$hauteur_image = ((count($tab_cam)+2) * 15) + 678;
	}
	else
	{
		$hauteur_image = (count($tab_cam)+2) * 15;
		if($hauteur_image < 550)
			$hauteur_image = 550;
		
	}
	
	$d = opendir('camembert');
	while (($file = readdir($d)) !==  false)
	{
		@unlink('camembert/' .$file);
	}
	closedir($d);
		
		
	$c = new Camembert(null, $tab_cam, 755, $hauteur_image);
	$c->init_libelle($tab_lib);
	
	if($_POST['choix'] == 'division')
	{
		if($_POST['division'] == 'Toute')
			$c->set_titre('Evolution de la demande par consommable du Rectorat du ' .$m ."/" .$annee);
		else
			$c->set_titre('Evolution de la demande par consommable du ' .$_POST['division'] .' du ' .$m ."/" .$annee);
		
	}
	else if($_POST['choix'] == 'division_service')
	{
		if($_POST['division'] == 'Toute')
			$c->set_titre('Evolution de la demande par service du Rectorat du ' .$m ."/" .$annee);
		else
			$c->set_titre('Evolution de la demande par service du ' .$_POST['division'] .' du ' .$m ."/" .$annee);
	
	}
	else if($_POST['choix'] == 'service')
		$c->set_titre('Evolution de la demande par consommable du ' .$_POST['service'] .' du ' .$m ."/" .$annee);
	
	if($_POST['choix'] == 'division_service')
	{
		if($_POST['division'] == 'Toute')
			$c->set_titre_lib('Service');
		else
			$c->set_titre_lib('Consommable');
	}
	else
	{
		$c->set_titre_lib('Consommable');
	}
	
	if(isset($_POST['etat']))
		$c->set_etat($_POST['etat']);
	else
		$c->set_etat(1);
	
	if(isset($_POST['sel_tr']))
		$c->set_sel_tranche($_POST['sel_tr']-1);
			
	if(isset($_POST['zoom']))
	{
		$c->set_indicateur(true);
		$c->set_epaisseur_cam(50);
		$c->set_taille_cam(400, 350);
		$c->set_position_lib(200, 678);
		$c->set_centre(378, 400);
		$c->set_ecartement(50);
		$c->set_position_titre(100, 0);
	
	}
	else
	{
		$c->set_indicateur_auto(true);
		$c->set_epaisseur_cam_auto(50);
		$c->set_ecartement_auto(50);
		$c->set_taille_cam_auto(250, 200);
		
	
	}
	
	$c->Dessine();
	
	
	echo '</td>';
	echo '</tr>';
	echo '</table>';

?>

	<div id="impr_lien3" class="imprimer_lien"  onmouseover="Souligne('impr_lien3');" onmouseout="DeSouligne('impr_lien3');" onclick="Fenetre_imprimer_conso('imprimer_image_sv_conso.php?nom_image=<?php echo $c->get_nom_image(); ?>')">
		<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
	</div>
	
	
	