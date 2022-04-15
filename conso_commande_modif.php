<?php
	
	$num_com = '';
	
	if(isset($_POST['ajax']))
	{
		session_start();
		
		header('Content-Type: text/html; charset=ISO-8859-1'); 
	
		include ('connect.php');
		
		$sql_conso_com = "SELECT *
						  FROM CONSOMMABLE AS C, COMMANDE AS CO, CONTENIR AS CONT
						  WHERE C.REFERENCE = CONT.REFERENCE
						  AND CONT.NUM_COMMANDE = CO.NUM_COMMANDE
						  AND CO.NUM_COMMANDE = '" .$_POST['num_com'] ."';";
						  
		$num_com = $_POST['num_com'];
		
	}
	else
	{
	
		$sql_conso_com = "SELECT *
						  FROM CONSOMMABLE AS C, COMMANDE AS CO, CONTENIR AS CONT
						  WHERE C.REFERENCE = CONT.REFERENCE
						  AND CONT.NUM_COMMANDE = CO.NUM_COMMANDE
						  AND CO.NUM_COMMANDE = '" .$_GET['num_com'] ."';";
						  
		$num_com = $_GET['num_com'];
							
	
	}
	
	$aff = true;
	
	if(isset($_POST['ajout']))
	{
		$sql_conso = "SELECT * FROM CONTENIR WHERE REFERENCE = '" .$_POST['ref_conso'] ."' AND NUM_COMMANDE = '" .$_POST['num_com'] ."';";
		$res_c = mysql_query($sql_conso);
		
		if(mysql_num_rows($res_c) > 0)
		{
			$sql_up = "UPDATE CONTENIR
					   SET QTE_COMMANDER = QTE_COMMANDER + 1
					   WHERE REFERENCE = '" .$_POST['ref_conso'] ."' AND NUM_COMMANDE = '" .$_POST['num_com'] ."';";
			mysql_query($sql_up)or die('Ajout conso ex:' .$sql_up);
		
		}
		else
		{
			$sql_prix = "SELECT PRIX_UNITAIRE FROM CONSOMMABLE WHERE REFERENCE = '" .$_POST['ref_conso'] ."';";
			$res_p = mysql_query($sql_prix);
			$prix = mysql_fetch_array($res_p);
							
			$sql_ins_cont = "INSERT INTO CONTENIR VALUES('" .$_POST['num_com'] ."', '" .$_POST['ref_conso'] ."', 1, " .$prix['PRIX_UNITAIRE'] .");";
			mysql_query($sql_ins_cont)or die('Ajout consommable:' .$sql_ins_cont);
				
		}
	
	}
	else if(isset($_POST['suppr']))
	{
		$sql_del = "DELETE FROM CONTENIR WHERE NUM_COMMANDE = '" .$_POST['num_com'] ."' AND REFERENCE = '" .$_POST['ref_conso'] ."';";
		mysql_query($sql_del)or die('Delete conso:' .$sql_del);
				
	}
	else if(isset($_POST['maj_qte']))
	{
		$sql_up = "UPDATE CONTENIR
				   SET QTE_COMMANDER = " .$_POST['maj_qte'] ." "
				 ."WHERE REFERENCE = '" .$_POST['ref_conso'] ."' AND NUM_COMMANDE = '" .$_POST['num_com'] ."';";
		mysql_query($sql_up)or die('Modif qte:' .$sql_up);
	
	}
	else if(isset($_POST['maj_num_com']))
	{
		$sql_up = "UPDATE COMMANDE
				   SET NUM_COMMANDE = '" .$_POST['maj_num_com'] ."' 
				   WHERE NUM_COMMANDE = '" .$_POST['num_com'] ."';";
		mysql_query($sql_up)or die('Maj Num_com:' .$sql_up);
		
		$sql_up_c = "UPDATE CONTENIR
					 SET NUM_COMMANDE = '" .$_POST['maj_num_com'] ."' 
					 WHERE NUM_COMMANDE = '" .$_POST['num_com'] ."';";
		mysql_query($sql_up_c)or die('Maj cont:' .$sql_up_c);
		
		$aff = false;
	
	}
	else if(isset($_POST['maj_date_com']))
	{
		$t_d = split('/', $_POST['maj_date_com']);
									
		$sql_up = "UPDATE COMMANDE
				   SET DATE_COMMANDE = '" .$t_d[2] ."-" .$t_d[1] ."-" .$t_d[0] ."' 
				   WHERE NUM_COMMANDE = '" .$_POST['num_com'] ."';";
		mysql_query($sql_up)or die('Maj Date_com:' .$sql_up);
		
		$aff = false;
	
	}
	
	if($aff)
	{
	
		$res_c = mysql_query($sql_conso_com)or die($sql_conso_com);
		
		if(mysql_num_rows($res_c) > 0)
		{


?>
			<form action="liste_commande.php" method="post">
			<table class="tab_commande" id="id_tab_com">
			<tr>
				<td class="titre_fond_bleu25" valign="top" colspan="7">
					Consommables de votre commande
				</td>
			</tr>
			<?php
				
					$sql_livr = "SELECT * FROM RECEVOIR WHERE NUM_COMMANDE = '" .$num_com."';";
					$res_l = mysql_query($sql_livr);
					
					if(mysql_num_rows($res_l) > 0)
					{
						echo '<tr>';
						echo '<td align="center" >N°livraison:</td>';
						echo '<td>';
								
						while($livraison = mysql_fetch_array($res_l))
						{
							echo '<a href="afficher_livraison.php?num_livr=' .$livraison['NUM_LIVRAISON'] .'&redirection=afficher_commande.php?num_com=' .$num_com .'">' .$livraison['NUM_LIVRAISON'] .'</a><br/>';
												
						}
						
						echo '</td></tr>';
						
						
					}
						
				
			?>
			<tr>
				<td class="cell_ref_com">Reference</td>
				<td class="cell_des_com_modif">Designation</td>
				<td class="cell_livre_com">Livré</td>
				<td class="cell_qte_com">Qte</td>
				<td class="cell_pu_com">PU</td>
				<td class="cell_ptot_com">Prix Tot</td>
				<td class="cell_suppr_com">S</td>
			</tr>

<?php

			$total = 0;
			$total_tva = 0;$i=1;
			while($conso = mysql_fetch_array($res_c))
			{
							
				echo '<tr>';
				echo '<td>' .$conso['REFERENCE'] .'</td>';
				echo '<td>' .$conso['DESIGNATION'] .'</td>';
				
				
				$sql_l = "SELECT SUM(QTE_LIVRE)
						  FROM RECEVOIR AS R, LIVRAISON AS L, LIVRER AS LI
						  WHERE R.NUM_COMMANDE = '" .$num_com ."'
						  AND R.NUM_LIVRAISON = L.NUM_LIVRAISON
						  AND L.NUM_LIVRAISON = LI.NUM_LIVRAISON
						  AND REFERENCE = '" .$conso['REFERENCE'] ."'
						  GROUP BY REFERENCE;";
				$res_l = mysql_query($sql_l);
				$nb = mysql_fetch_array($res_l);
				if($nb[0] == '')
					$nb[0] = 0;
				
				if($nb[0] < $conso['QTE_COMMANDER'])
					echo '<td align="center" class="rouge">' .$nb[0] .'</td>';
				else
					echo '<td align="center">' .$nb[0] .'</td>';
				
				
				echo '</td>';
				echo '<td><input type="text" name="qte" value="' .$conso['QTE_COMMANDER'] .'" class="text_60" id="qte_' .$i .'" onblur="Valider_quantite_com_modif(' .$i .", '" .$conso['NUM_COMMANDE'] ."','" .$conso['REFERENCE'] ."');" .'"' .'/></td>';
				echo '<td align="center">' .round($conso['PRIX_CONSO'], 2) .'&#8364;</td>';
				echo '<td align="center">' .($conso['QTE_COMMANDER'] * round($conso['PRIX_CONSO'], 2)) .'&#8364;</td>';
				echo '<td><img src="Image/suppr.gif" alt="Supprimer le consommable de la demande" onclick="Retirer_conso_commande_modif(' ."'" .$conso['NUM_COMMANDE'] ."','" .$conso['REFERENCE'] ."'" .');" /></td>';
				echo '</tr>';
				
				$sql_tva = "SELECT * FROM TVA WHERE CODE_TVA = " .$conso['CODE_TVA'];
				$res_tva = mysql_query($sql_tva);
				$tva = mysql_fetch_array($res_tva);
				
				$total_tva += round((($conso['PRIX_CONSO'] * $conso['QTE_COMMANDER']) * $tva['TAUX_TVA']) / 100, 2);
				$total += ($conso['QTE_COMMANDER'] * round($conso['PRIX_CONSO'], 2));
				
				$i++;
			
			}
			
			echo '<tr><td colspan="3" align="right" class="cell_total">Total TVA</td><td colspan="4" align="center" class="cell_total_p">' .$total_tva .'&#8364;</td></tr>';
			echo '<tr><td colspan="3" align="right" >Total TTC</td><td colspan="4" align="center" class="cell_total_p">' .$total .'&#8364;</td></tr>';
			


?>
	
			<tr>
				<td class="titre_fond_bleu25" colspan="7">
					<input type="button" name="valider" id="b_valider_com" value="Supprimer la commande" class="bouton_blanc12" onclick="Supprimer_commande();"/>
					<input type="submit" name="retour" value="Retour" class="bouton_blanc12"/>
					
				</td>
			</tr>

			</table>
			</form>
			<input type="hidden" id="val_dem" value="oui" />
			
			<form action="liste_commande.php?retour=retour" method="post" id="form_retour">
			</form>
		
		
		
<?php

		}

	}


?>
		
		
		
		