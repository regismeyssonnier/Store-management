<div style="position:absolute;">

	<ul class="menu_blanc">
		<li class="titre_fond_blanc">DEMANDE</li>
		<li id="elem_mg_1" onmouseover="Sur_menu('elem_mg_1', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg_1');"><a href="effectuer_demande.php" id="elem_mg_1a">Saisie demande</a></li>
		<li id="elem_mg_2" onmouseover="Sur_menu('elem_mg_2', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg_2');"><a href="suivre_demande.php" id="elem_mg_2a">Suivi demande</a></li>
	<?php if(($_SESSION['type_util'] == 'Administrateur') || ($_SESSION['type_util'] == 'Gestionnaire des stocks')){ ?>
		<li id="elem_mg_3" onmouseover="Sur_menu('elem_mg_3', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg_3');"><a href="traiter_demande.php" id="elem_mg_3a">Traiter demande</a></li>
		<li id="elem_mg_4" onmouseover="Sur_menu('elem_mg_4', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg_4');"><a href="archiver_demande.php" id="elem_mg_4a">Archiver demande</a></li>
	<?php } ?>	
		<!--<li id="elem_mg_5" onmouseover="Sur_menu('elem_mg_5', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_5');"><a href="mod_acces.html" id="elem_mg_5a">Modalit&eacute;s d&rsquo;acc&egrave;s</a></li>
		<li id="elem_mg_6" onmouseover="Sur_menu('elem_mg_6', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_6');"><a href="organisation.html" id="elem_mg_6a">Organisation des &eacute;tudes</a></li>
		<li id="elem_mg_7" onmouseover="Sur_menu('elem_mg_7', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_7');"><a href="programme.html" id="elem_mg_7a">Programme</a></li>
		<li id="elem_mg_8" onmouseover="Sur_menu('elem_mg_8', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_8');"><a href="controle.html" id="elem_mg_8a">Contr&ocirc;les connaissances</a></li>
		<li id="elem_mg_9" onmouseover="Sur_menu('elem_mg_9', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_9');"><a href="partenariat.html" id="elem_mg_9a">Partenariat</a></li>
		<li id="elem_mg_10" onmouseover="Sur_menu('elem_mg_10', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_10');"><a href="emploi.html" id="elem_mg_10a">Emploi, secteur et demande</a></li>
		
		-->
		
	</ul>

	<?php if(($_SESSION['type_util'] == 'Administrateur') || ($_SESSION['type_util'] == 'Gestionnaire des stocks')){ ?>
	
	<ul class="menu_blanc">
		<li class="titre_fond_blanc">CONFIGURATION</li>
		<li id="elem_mg7_1" onmouseover="Sur_menu('elem_mg7_1', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg7_1');"><a href="saisir_conso.php" id="elem_mg7_1a">Saisie reference</a></li>
		<li id="elem_mg7_2" onmouseover="Sur_menu('elem_mg7_2', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg7_2');"><a href="saisir_utilisateur.php" id="elem_mg7_2a">Saisie utilisateur</a></li>
		<li id="elem_mg7_3" onmouseover="Sur_menu('elem_mg7_3', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg7_3');"><a href="liste_utilisateur.php" id="elem_mg7_3a">Liste utilisateur</a></li>
		<li id="elem_mg7_4" onmouseover="Sur_menu('elem_mg7_4', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg7_4');"><a href="tva.php" id="elem_mg7_4a">Gestion tva</a></li>
		<li id="elem_mg7_5" onmouseover="Sur_menu('elem_mg7_5', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg7_5');"><a href="type_conso.php" id="elem_mg7_5a">Gestion type consommable</a></li>
		<li id="elem_mg7_6" onmouseover="Sur_menu('elem_mg7_6', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg7_6');"><a href="type_imprimante.php" id="elem_mg7_6a">Gestion type imprimante</a></li>
		<li id="elem_mg7_7" onmouseover="Sur_menu('elem_mg7_7', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg7_7');"><a href="marque.php" id="elem_mg7_7a">Gestion marque imprimante</a></li>
		<li id="elem_mg7_8" onmouseover="Sur_menu_ss_men('elem_mg7_8', 'fond_blanc.gif', 'black', 'ss_men_g_div');" onmouseout="Sortie_menu_c('elem_mg7_8', 'ss_men_g_div');"><a id="elem_mg7_8a">Gestion division</a></li>
		<li id="elem_mg7_9" onmouseover="Sur_menu_ss_men2('elem_mg7_9', 'fond_blanc.gif', 'black', 'ss_men_g_ser');" onmouseout="Sortie_menu_c2('elem_mg7_9', 'ss_men_g_ser');"><a id="elem_mg7_9a">Gestion service</a></li>
		
	</ul>
	
	<ul class="sous_gestion_div" id="ss_men_g_div">
		<li id="elem_mgs7_1" onmouseover="Sur_ss_menu('elem_mgs7_1', 'fond_blanc.gif', 'black');" onmouseout="Sortie_ss_menu('elem_mgs7_1', 'ss_men_g_div');"><a href="ajouter_division.php" id="elem_mgs7_1a">Ajouter division</a></li>
		<li id="elem_mgs7_2" onmouseover="Sur_ss_menu('elem_mgs7_2', 'fond_blanc.gif', 'black');" onmouseout="Sortie_ss_menu('elem_mgs7_2', 'ss_men_g_div');"><a href="fusionner_division.php" id="elem_mgs7_2a">Fusionner 2 divisions</a></li>
		<li id="elem_mgs7_3" onmouseover="Sur_ss_menu('elem_mgs7_3', 'fond_blanc.gif', 'black');" onmouseout="Sortie_ss_menu('elem_mgs7_3', 'ss_men_g_div');"><a href="modif_suppr_division.php" id="elem_mgs7_3a">Modif/Suppr division</a></li>
		
	</ul>
	
	<ul class="sous_gestion_ser" id="ss_men_g_ser">
		<li id="elem_mgs17_1" onmouseover="Sur_ss_menu2('elem_mgs17_1', 'fond_blanc.gif', 'black');" onmouseout="Sortie_ss_menu2('elem_mgs17_1', 'ss_men_g_ser');"><a href="ajouter_service.php" id="elem_mgs17_1a">Ajouter service</a></li>
		<li id="elem_mgs17_2" onmouseover="Sur_ss_menu2('elem_mgs17_2', 'fond_blanc.gif', 'black');" onmouseout="Sortie_ss_menu2('elem_mgs17_2', 'ss_men_g_ser');"><a href="modif_suppr_service.php" id="elem_mgs17_2a">Modif/suppr service</a></li>
		
	</ul>
	
	<ul class="menu_blanc">
		<li class="titre_fond_blanc">SUIVI DU STOCK</li>
		<!--<li id="elem_mg2_1" onmouseover="Sur_menu('elem_mg2_1', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg2_1');"><a href="saisir_conso.php" id="elem_mg2_1a">Saisir consommable</a></li>-->
		<li id="elem_mg2_2" onmouseover="Sur_menu('elem_mg2_2', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg2_2');"><a href="liste_conso.php" id="elem_mg2_2a">Liste des références</a></li>
		<li id="elem_mg2_3" onmouseover="Sur_menu('elem_mg2_3', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg2_3');"><a href="etat_stock.php" id="elem_mg2_3a">Etat des stocks</a></li>
		<li id="elem_mg2_4" onmouseover="Sur_menu('elem_mg2_4', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg2_4');"><a href="suivi_consommation.php" id="elem_mg2_4a">Suivi de consommation</a></li>			
		<li id="elem_mg2_5" onmouseover="Sur_menu('elem_mg2_5', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg2_5');"><a href="liste_conso_reap.php" id="elem_mg2_5a">Références à commander</a></li>		
		
	</ul>
	
	<ul class="menu_blanc">
		<li class="titre_fond_blanc">ARCHIVE</li>
		<li id="elem_mg9_1" onmouseover="Sur_menu_ss_men('elem_mg9_1', 'fond_blanc.gif', 'black', 'ss_men_archive_div');" onmouseout="Sortie_menu_c('elem_mg9_1', 'ss_men_archive_div');"><a id="elem_mg9_1a">Division</a></li>
		<li id="elem_mg9_2" onmouseover="Sur_menu('elem_mg9_2', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg9_2');"><a href="archive_demande.php" id="elem_mg9_2a">Demande</a></li>
		<!--<li id="elem_mg8_3" onmouseover="Sur_menu('elem_mg8_3', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg8_3');"><a href="imprimante_par_service.php" id="elem_mg8_3a">Liste imprimante par service</a></li>
	
		<li id="elem_mg_4" onmouseover="Sur_menu('elem_mg_4', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_4');"><a href="comp_acquise.html" id="elem_mg_4a">Comp&eacute;tences acquises</a></li>
		<li id="elem_mg_5" onmouseover="Sur_menu('elem_mg_5', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_5');"><a href="mod_acces.html" id="elem_mg_5a">Modalit&eacute;s d&rsquo;acc&egrave;s</a></li>
		<li id="elem_mg_6" onmouseover="Sur_menu('elem_mg_6', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_6');"><a href="organisation.html" id="elem_mg_6a">Organisation des &eacute;tudes</a></li>
		<li id="elem_mg_7" onmouseover="Sur_menu('elem_mg_7', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_7');"><a href="programme.html" id="elem_mg_7a">Programme</a></li>
		<li id="elem_mg_8" onmouseover="Sur_menu('elem_mg_8', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_8');"><a href="controle.html" id="elem_mg_8a">Contr&ocirc;les connaissances</a></li>
		<li id="elem_mg_9" onmouseover="Sur_menu('elem_mg_9', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_9');"><a href="partenariat.html" id="elem_mg_9a">Partenariat</a></li>
		<li id="elem_mg_10" onmouseover="Sur_menu('elem_mg_10', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_10');"><a href="emploi.html" id="elem_mg_10a">Emploi, secteur et demande</a></li>
		
		-->
		
	</ul>
	
	<ul class="sous_archive_div" id="ss_men_archive_div">
		<li id="elem_mgs9_1" onmouseover="Sur_ss_menu('elem_mgs9_1', 'fond_blanc.gif', 'black');" onmouseout="Sortie_ss_menu('elem_mgs9_1', 'ss_men_archive_div');"><a href="archive_division.php" id="elem_mgs9_1a">Archive division</a></li>
		<li id="elem_mgs9_2" onmouseover="Sur_ss_menu('elem_mgs9_2', 'fond_blanc.gif', 'black');" onmouseout="Sortie_ss_menu('elem_mgs9_2', 'ss_men_archive_div');"><a href="suppr_archive_division.php" id="elem_mgs9_2a">Supprimer division archive</a></li>
	</ul>
	
	<ul class="menu_blanc">
		<li class="titre_fond_blanc">IMPRIMANTE</li>
		<li id="elem_mg8_1" onmouseover="Sur_menu('elem_mg8_1', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg8_1');"><a href="saisir_imprimante.php" id="elem_mg8_1a">Saisie imprimante</a></li>
		<li id="elem_mg8_2" onmouseover="Sur_menu('elem_mg8_2', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg8_2');"><a href="liste_imprimante.php" id="elem_mg8_2a">Liste imprimante</a></li>
		<li id="elem_mg8_3" onmouseover="Sur_menu('elem_mg8_3', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg8_3');"><a href="imprimante_par_service.php" id="elem_mg8_3a">Liste imprimante par service</a></li>
		<li id="elem_mg8_4" onmouseover="Sur_menu('elem_mg8_4', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg8_4');"><a href="nb_imprimante_par_service.php" id="elem_mg8_4a">Nb imprimante par service</a></li>
	
		<!--<li id="elem_mg_5" onmouseover="Sur_menu('elem_mg_5', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_5');"><a href="mod_acces.html" id="elem_mg_5a">Modalit&eacute;s d&rsquo;acc&egrave;s</a></li>
		<li id="elem_mg_6" onmouseover="Sur_menu('elem_mg_6', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_6');"><a href="organisation.html" id="elem_mg_6a">Organisation des &eacute;tudes</a></li>
		<li id="elem_mg_7" onmouseover="Sur_menu('elem_mg_7', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_7');"><a href="programme.html" id="elem_mg_7a">Programme</a></li>
		<li id="elem_mg_8" onmouseover="Sur_menu('elem_mg_8', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_8');"><a href="controle.html" id="elem_mg_8a">Contr&ocirc;les connaissances</a></li>
		<li id="elem_mg_9" onmouseover="Sur_menu('elem_mg_9', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_9');"><a href="partenariat.html" id="elem_mg_9a">Partenariat</a></li>
		<li id="elem_mg_10" onmouseover="Sur_menu('elem_mg_10', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_10');"><a href="emploi.html" id="elem_mg_10a">Emploi, secteur et demande</a></li>
		
		-->
		
	</ul>
	

	<ul class="menu_blanc">
		<li class="titre_fond_blanc">COMMANDE</li>
		<li id="elem_mg3_1" onmouseover="Sur_menu('elem_mg3_1', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg3_1');"><a href="saisir_commande.php" id="elem_mg3_1a">Saisie commande</a></li>
		<li id="elem_mg3_2" onmouseover="Sur_menu('elem_mg3_2', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg3_2');"><a href="liste_commande.php" id="elem_mg3_2a">Liste commande</a></li>
		<!--<li id="elem_mg2_3" onmouseover="Sur_menu('elem_mg2_3', 'fond_rouge.gif');" onmouseout="Sortie_menu('elem_mg2_3');"><a href="deconnexion.php" id="elem_mg2_3a">Se déconnecter</a></li>-->
						
		
	</ul>

	<ul class="menu_blanc">
		<li class="titre_fond_blanc">LIVRAISON</li>
		<li id="elem_mg4_1" onmouseover="Sur_menu('elem_mg4_1', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg4_1');"><a href="saisir_livraison.php" id="elem_mg4_1a">Saisie livraison</a></li>
		<li id="elem_mg4_2" onmouseover="Sur_menu('elem_mg4_2', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg4_2');"><a href="liste_livraison.php" id="elem_mg4_2a">Liste livraison</a></li>
		<!--<li id="elem_mg_3" onmouseover="Sur_menu('elem_mg_3', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_3');"><a href="mail_etudiant.php" id="elem_mg_3a">Traiter commande</a></li>
		
		<li id="elem_mg_4" onmouseover="Sur_menu('elem_mg_4', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_4');"><a href="comp_acquise.html" id="elem_mg_4a">Comp&eacute;tences acquises</a></li>
		<li id="elem_mg_5" onmouseover="Sur_menu('elem_mg_5', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_5');"><a href="mod_acces.html" id="elem_mg_5a">Modalit&eacute;s d&rsquo;acc&egrave;s</a></li>
		<li id="elem_mg_6" onmouseover="Sur_menu('elem_mg_6', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_6');"><a href="organisation.html" id="elem_mg_6a">Organisation des &eacute;tudes</a></li>
		<li id="elem_mg_7" onmouseover="Sur_menu('elem_mg_7', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_7');"><a href="programme.html" id="elem_mg_7a">Programme</a></li>
		<li id="elem_mg_8" onmouseover="Sur_menu('elem_mg_8', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_8');"><a href="controle.html" id="elem_mg_8a">Contr&ocirc;les connaissances</a></li>
		<li id="elem_mg_9" onmouseover="Sur_menu('elem_mg_9', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_9');"><a href="partenariat.html" id="elem_mg_9a">Partenariat</a></li>
		<li id="elem_mg_10" onmouseover="Sur_menu('elem_mg_10', 'fond_bleu.gif');" onmouseout="Sortie_menu('elem_mg_10');"><a href="emploi.html" id="elem_mg_10a">Emploi, secteur et demande</a></li>
		
		-->
		
	</ul>
	<?php } ?>
	
	<?php if( ($_SESSION['type_util'] == 'Administrateur') || ($_SESSION['type_util'] == 'Controleur de gestion') || ($_SESSION['type_util'] == 'Gestionnaire des stocks') ){ ?>
	<ul class="menu_blanc">
		<li class="titre_fond_blanc">GESTION CONSO</li>
		<li id="elem_mg5_1" onmouseover="Sur_menu('elem_mg5_1', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg5_1');"><a href="cout_achat.php" id="elem_mg5_1a">Cout d'achat</a></li>
		<li id="elem_mg5_2" onmouseover="Sur_menu('elem_mg5_2', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg5_2');"><a href="evolution_demande.php" id="elem_mg5_2a">Evolution demande</a></li>
		<!--<li id="elem_mg2_3" onmouseover="Sur_menu('elem_mg2_3', 'fond_blanc.gif');" onmouseout="Sortie_menu('elem_mg2_3');"><a href="deconnexion.php" id="elem_mg2_3a">Etat des stocks</a></li>
		<li id="elem_mg2_4" onmouseover="Sur_menu('elem_mg2_4', 'fond_blanc.gif');" onmouseout="Sortie_menu('elem_mg2_4');"><a href="deconnexion.php" id="elem_mg2_4a">Suivi de consommation</a></li>	
		-->
		
	</ul>
	<?php } ?>
	
	<ul class="menu_blanc">
		<li class="titre_fond_blanc">DECONNEXION</li>
		<li id="elem_mg6_1" onmouseover="Sur_menu('elem_mg6_1', 'fond_blanc.gif', 'black');" onmouseout="Sortie_menu('elem_mg6_1');"><a href="deconnexion.php" id="elem_mg6_1a">Se d&eacute;connecter</a></li>
		<!--<li id="elem_mg2_2" onmouseover="Sur_menu('elem_mg2_2', 'fond_blanc.gif');" onmouseout="Sortie_menu('elem_mg2_2');"><a href="modif_info.php" id="elem_mg2_2a">Evolution demande</a></li>
		<li id="elem_mg2_3" onmouseover="Sur_menu('elem_mg2_3', 'fond_blanc.gif');" onmouseout="Sortie_menu('elem_mg2_3');"><a href="deconnexion.php" id="elem_mg2_3a">Etat des stocks</a></li>
		<li id="elem_mg2_4" onmouseover="Sur_menu('elem_mg2_4', 'fond_blanc.gif');" onmouseout="Sortie_menu('elem_mg2_4');"><a href="deconnexion.php" id="elem_mg2_4a">Suivi de consommation</a></li>	
		-->
		
	</ul>


</div>







