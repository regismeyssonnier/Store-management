<?php

	include('diagramme.php');
	
	$sql_diag = '';
	$date_1 = '';
	$date_2 = '';
	$division = '';
	$service = '';
	$page = 1;
	$choix_suivi = '';
		
	if(isset($_POST['ajax_d']))
	{
		include('connect.php');
		
		$choix_suivi = $_POST['choix'];
				
		if(($choix_suivi == 'division') || ($choix_suivi == 'division_service'))
		{
			if($_POST['division'] == 'Toute')
			{
				$sql_diag = "SELECT MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, DESIGNATION, SUM(QTE_COMMANDER), PRIX_CONSO
							 FROM CONSOMMABLE AS C, CONTENIR AS CO, COMMANDE AS COM
							 WHERE DATE_COMMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."' 
							 AND C.REFERENCE = CO.REFERENCE
							 AND CO.NUM_COMMANDE = COM.NUM_COMMANDE
							 GROUP BY MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, PRIX_CONSO 
							 HAVING SUM(QTE_COMMANDER) > 0;";
			
			}
			else
			{
			
				$sql_diag = "SELECT MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, DESIGNATION, SUM(QTE_COMMANDER), PRIX_CONSO
							 FROM CONSOMMABLE AS C, CONTENIR AS CO, COMMANDE AS COM, UTILISATEUR AS U, SERVICE AS S
							 WHERE DATE_COMMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."' 
							 AND C.REFERENCE = CO.REFERENCE
							 AND CO.NUM_COMMANDE = COM.NUM_COMMANDE
							 AND COM.ID_UTILISATEUR = U.ID_UTILISATEUR
							 AND U.ID_SERVICE = S.ID_SERVICE
							 AND S.ID_DIVISION = '" .$_POST['division'] ."' 
						     GROUP BY MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, PRIX_CONSO 
							 HAVING SUM(QTE_COMMANDER) > 0;";
							 
			}
			
						 
			$page = $_POST['page'];
			$date_1 = $_POST['date1'];
			$date_2 = $_POST['date2'];
			$division = $_POST['division'];
			
		}
		else if($choix_suivi == 'service')
		{
			$sql_diag = "SELECT MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, DESIGNATION, SUM(QTE_COMMANDER), PRIX_CONSO
						 FROM CONSOMMABLE AS C, CONTENIR AS CO, COMMANDE AS COM, UTILISATEUR AS U
						 WHERE DATE_COMMANDE BETWEEN '" .$_POST['date1'] ."' AND '" .$_POST['date2'] ."' 
						 AND C.REFERENCE = CO.REFERENCE
						 AND CO.NUM_COMMANDE = COM.NUM_COMMANDE
						 AND COM.ID_UTILISATEUR = U.ID_UTILISATEUR
						 AND U.ID_SERVICE = '" .$_POST['service'] ."' "
					   ."GROUP BY MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, PRIX_CONSO 
						 HAVING SUM(QTE_COMMANDER) > 0;";
						  
		
			$page = $_POST['page'];
			$date_1 = $_POST['date1'];
			$date_2 = $_POST['date2'];
			$service = $_POST['service'];
					
		}
		
	
	}
	else
	{
		$choix_suivi = $choix;
		
		if(($choix_suivi == 'division') || ($choix_suivi == 'division_service'))
		{
			if($_POST['division'] == 'Toute')
			{
				$sql_diag = "SELECT MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, DESIGNATION, SUM(QTE_COMMANDER), PRIX_CONSO
							 FROM CONSOMMABLE AS C, CONTENIR AS CO, COMMANDE AS COM
							 WHERE DATE_COMMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."' 
							 AND C.REFERENCE = CO.REFERENCE
							 AND CO.NUM_COMMANDE = COM.NUM_COMMANDE
							 GROUP BY MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, PRIX_CONSO 
							 HAVING SUM(QTE_COMMANDER) > 0;";
			
			}
			else
			{
		
				$sql_diag = "SELECT MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, DESIGNATION, SUM(QTE_COMMANDER), PRIX_CONSO
							 FROM CONSOMMABLE AS C, CONTENIR AS CO, COMMANDE AS COM, UTILISATEUR AS U, SERVICE AS S
							 WHERE DATE_COMMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."' 
							 AND C.REFERENCE = CO.REFERENCE
							 AND CO.NUM_COMMANDE = COM.NUM_COMMANDE
							 AND COM.ID_UTILISATEUR = U.ID_UTILISATEUR
							 AND U.ID_SERVICE = S.ID_SERVICE
							 AND S.ID_DIVISION = '" .$_POST['division'] ."' 
						     GROUP BY MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, PRIX_CONSO 
							 HAVING SUM(QTE_COMMANDER) > 0;";
							 
			}
						
			$date_1 = $date1;
			$date_2 = $date2;
			$division = $_POST['division'];
		
		
		}
		else if($choix_suivi == 'service')
		{
			$sql_diag = "SELECT MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, DESIGNATION, SUM(QTE_COMMANDER), PRIX_CONSO
						 FROM CONSOMMABLE AS C, CONTENIR AS CO, COMMANDE AS COM, UTILISATEUR AS U
						 WHERE DATE_COMMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."' 
						 AND C.REFERENCE = CO.REFERENCE
						 AND CO.NUM_COMMANDE = COM.NUM_COMMANDE
						 AND COM.ID_UTILISATEUR = U.ID_UTILISATEUR
						 AND U.ID_SERVICE = '" .$_POST['service'] ."' "
					   ."GROUP BY MONTH(DATE_COMMANDE), YEAR(DATE_COMMANDE), C.REFERENCE, PRIX_CONSO 
						 HAVING SUM(QTE_COMMANDER) > 0;";
						  
		
			$date_1 = $date1;
			$date_2 = $date2;
			$service = $_POST['service'];
		
		}
					 
	}
	
	$res_d = mysql_query($sql_diag)or die($sql_diag);
								
	$tab_diag = array();
	$tab_mois = array();
	$tab_annee = array();
	$prem = true;
	$mois = '';$annee = '';
	$i = 0;
	$somme = 0;
	$max_somme = 0;
	while($diag = mysql_fetch_array($res_d))
	{
		if( (($mois != $diag[0]) || ($annee != $diag[1])) && !$prem )
		{
			if($max_somme < $somme)
				$max_somme = $somme;
			$tab_diag[$i] = $somme;
			$tab_mois[$i] = $mois;
			$tab_annee[$i] = $annee;
			$somme = 0;
			$i++;
							
		}
		
		$somme += round($diag[4] * $diag[5], 2);
		$mois = $diag[0];
		$annee = $diag[1];
		$prem = false;

	}

	$tab_diag[$i] = $somme;
	$tab_mois[$i] = $mois;
	$tab_annee[$i] = $annee;
	if($max_somme < $somme)
		$max_somme = $somme;
				
	
	$baton_par_diag = 1;
	$nb_baton = count($tab_diag);
	$max_page = $nb_baton / $baton_par_diag;
	if(($max_page > 0) && ($max_page < 1))$max_page = 1;
	else $max_page = ceil($max_page);
					
	$index = ($page - 1) * $baton_par_diag;

	$t_baton = array();
	$t_mois = array();
	$t_annee = array();
	$j = 0;
	for($i = $index;($i < ($index + $baton_par_diag)) && ($i < $nb_baton);$i++)
	{
		$t_baton[$j] = $tab_diag[$i];
		$t_mois[$j] = $tab_mois[$i];
		$t_annee[$j] = $tab_annee[$i];
		$j++;
	}
					

	echo '<table class="tab_suivi_conso">';
	echo '<tr>';
	echo '<td class="titre_fond_bleu25">';

	echo '<table>';
	echo '<tr>';
	echo '<td class="cell_pied_tabc" id="pg_prec"';
	$p_prec = $page - 1;
	if($page > 1)
	{
		if(($choix_suivi == 'division') || ($choix_suivi == 'division_service'))
			echo 'onmouseover="Souligne(\'pg_prec\');" onmouseout="DeSouligne(\'pg_prec\');" onclick="Diagramme_pagination_division_ca(' .$p_prec .", '" .$date_1 ."', '" .$date_2 ."', '" .$division ."', '" .$choix_suivi .'\');"';
		else if($choix_suivi == 'service')
			echo 'onmouseover="Souligne(\'pg_prec\');" onmouseout="DeSouligne(\'pg_prec\');" onclick="Diagramme_pagination_service_ca(' .$p_prec .", '" .$date_1 ."', '" .$date_2 ."', '" .$service .'\');"';
		
	}
	echo '>';
	if($page > 1)
		echo "<< page prec";
	echo '</td>';
	echo '<td class="cell_pied_tabm">Suivi de consommation</td>';
	echo '<td class="cell_pied_tabc" id="pg_suiv"';
	$p_suiv = $page + 1;
	if($page < $max_page)
	{
		if(($choix_suivi == 'division') || ($choix_suivi == 'division_service'))
			echo 'onmouseover="Souligne(\'pg_suiv\');" onmouseout="DeSouligne(\'pg_suiv\');" onclick="Diagramme_pagination_division_ca(' .$p_suiv .", '" .$date_1 ."', '" .$date_2 ."', '" .$division ."', '" .$choix_suivi .'\');"';
		else if($choix_suivi == 'service')
			echo 'onmouseover="Souligne(\'pg_suiv\');" onmouseout="DeSouligne(\'pg_suiv\');" onclick="Diagramme_pagination_service_ca(' .$p_suiv .", '" .$date_1 ."', '" .$date_2 ."', '" .$service .'\');"';
		
	}
	echo '>';
	if($page < $max_page)
		echo "page suiv >>";
	echo '</td>';
	echo '</tr>';
	echo '</table>';

	echo '</tr>';
	echo '<tr>';
	echo '<td align="center">';

	$d = opendir('diagramme');
	while (($file = readdir($d)) !==  false)
	{
		@unlink('diagramme/' .$file);
	}
	closedir($d);

	$d = new Diagramme(null, $t_baton, 755, 450);
	$d->set_grille(480, 300);

	$n = count($t_mois);
	$tmois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	$t_lib = array();
	$t_val = array();
	for($i = 0;$i < $n;$i++)
	{
		$t_lib[$i] = $tmois[$t_mois[$i]-1] ." " .$t_annee[$i];
		$t_val[$i] = $t_mois[$i] ."-" .$t_annee[$i];

	}
				
	$d->set_libelle($t_lib);
	$d->set_position_lib(1);
	$d->set_meme_couleur(false);
	
	$d1 = split("-", $date_1);
	$d2 = split("-", $date_2);
	$dt1 = $d1[2] ."/" .$d1[1] ."/" .$d1[0];
	$dt2 = $d2[2] ."/" .$d2[1] ."/" .$d2[0];
	
	if(($choix_suivi == 'division') || ($choix_suivi == 'division_service'))
	{
		if($_POST['division'] == 'Toute')
			$d->set_titre('Cout d\'achat du Rectorat du ' .$dt1 .' au ' .$dt2);
		else
			$d->set_titre('Cout d\'achat du ' .$_POST['division'] .' du ' .$dt1 .' au ' .$dt2);
		
	}
	else
		$d->set_titre('Cout d\'achat du ' .$_POST['service'] .' du ' .$dt1 .' au ' .$dt2);
		
	$d->set_titre_lib('Mois');
	$d->set_nom_map('diagramme');
	$d->set_pct(false);
	$d->set_virgule(true);
	$d->set_max_grille($max_somme);
	$d->set_titre_axe_y("Euros");
	$d->set_ajouter_titre_axe_y_lib(true);
	$d->set_lib_dessous_freq(true);
	$d->set_tab_valeur_baton($t_val);
	$d->Dessine();
		


	echo '</td>';
	echo '</tr>';
	echo '</table>';

	$t = $d->get_map_point();
	$n = count($t);
	echo '<map name="diagramme">';
	for($i=0;$i<$n;$i++)
	{
		if(($choix_suivi == 'division') || ($choix_suivi == 'division_service'))
			echo '<area shape="rect" coords="' .$t[$i]->point1->x  ."," .$t[$i]->point1->y ."," .$t[$i]->point2->x ."," .$t[$i]->point2->y .'" href="javascript:Camembert_ca_division(\'' .$date_1 ."', '" .$date_2 ."', '" .$division ."', '" .$t[$i]->valeur ."', '" .$choix_suivi .'\');" alt="' .$t[$i]->nom .'"/>';
		else if($choix_suivi == 'service')
			echo '<area shape="rect" coords="' .$t[$i]->point1->x  ."," .$t[$i]->point1->y ."," .$t[$i]->point2->x ."," .$t[$i]->point2->y .'" href="javascript:Camembert_ca_service(\'' .$date_1 ."', '" .$date_2 ."', '" .$service ."', '" .$t[$i]->valeur .'\');" alt="' .$t[$i]->nom .'"/>';
		
	}
	echo '</map>';	
	
?>

	<div id="impr_lien2" class="imprimer_lien"  onmouseover="Souligne('impr_lien2');" onmouseout="DeSouligne('impr_lien2');" onclick="Fenetre_imprimer_conso('imprimer_image_sv_conso.php?nom_image=<?php echo $d->get_nom_image(); ?>')">
		<img src="Image/imprimante.gif" alt="Imprimer"  /> Imprimer
	</div>