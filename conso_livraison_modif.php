<?php

	$num_livr = '';
	if(isset($_POST['ajax']))
	{
		session_start();
	
		include ('connect.php');
		
		$sql_conso_livr = "SELECT *
						  FROM CONSOMMABLE AS C, LIVRAISON AS L, LIVRER AS LI
						  WHERE C.REFERENCE = LI.REFERENCE
						  AND LI.NUM_LIVRAISON = L.NUM_LIVRAISON
						  AND L.NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
						  
		$num_livr = $_POST['num_livr'];
		
	}
	else
	{
	
		$sql_conso_livr = "SELECT *
						  FROM CONSOMMABLE AS C, LIVRAISON AS L, LIVRER AS LI
						  WHERE C.REFERENCE = LI.REFERENCE
						  AND LI.NUM_LIVRAISON = L.NUM_LIVRAISON
						  AND L.NUM_LIVRAISON = '" .$_GET['num_livr'] ."';";
						  
		$num_livr = $_GET['num_livr'];
							
	
	}
	
	$sql_rec = "SELECT * FROM RECEVOIR WHERE NUM_LIVRAISON = '" .$num_livr ."';";
	$res_r = mysql_query($sql_rec);
	$num_c_l = mysql_fetch_array($res_r);
	
	$aff = true;
	
	if(isset($_POST['ajout']))
	{
		
	
		$sql_conso = "SELECT * FROM LIVRER WHERE REFERENCE = '" .$_POST['ref_conso'] ."' AND NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
		$res_l = mysql_query($sql_conso);
		
		if(mysql_num_rows($res_l) > 0)
		{
			$livrer = mysql_fetch_array($res_l);
			
			$sql_conso = "SELECT *
						  FROM CONSOMMABLE AS C, CONTENIR AS CONT
						  WHERE C.REFERENCE = CONT.REFERENCE
						  AND CONT.NUM_COMMANDE = '" .$num_c_l['NUM_COMMANDE'] ."'
						  AND C.REFERENCE = '" .$_POST['ref_conso'] ."';";
			$res_conso = mysql_query($sql_conso);
			$conso_com = mysql_fetch_array($res_conso);
		
			if($livrer['QTE_LIVRE'] < $conso_com['QTE_COMMANDER'])
			{
				$sql_up = "UPDATE LIVRER
						   SET QTE_LIVRE = QTE_LIVRE + 1
						   WHERE REFERENCE = '" .$_POST['ref_conso'] ."' AND NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
				mysql_query($sql_up)or die('Ajout conso ex:' .$sql_up);
				
				$sql_stock = "UPDATE CONSOMMABLE
							  SET QTE_STOCK = QTE_STOCK + 1 
							  WHERE REFERENCE = '" .$_POST['ref_conso'] ."';";
				mysql_query($sql_stock)or die($sql_stock);
				
			}
		}
		else
		{
			$sql_prix = "SELECT PRIX_UNITAIRE FROM CONSOMMABLE WHERE REFERENCE = '" .$_POST['ref_conso'] ."';";
			$res_p = mysql_query($sql_prix);
			$prix = mysql_fetch_array($res_p);
							
			$sql_ins_livr = "INSERT INTO LIVRER VALUES('" .$_POST['num_livr'] ."', '" .$_POST['ref_conso'] ."', 1, " .$prix['PRIX_UNITAIRE'] .");";
			mysql_query($sql_ins_livr)or die('Ajout consommable:' .$sql_ins_livr);
			
			$sql_stock = "UPDATE CONSOMMABLE
						  SET QTE_STOCK = QTE_STOCK + 1 
						  WHERE REFERENCE = '" .$_POST['ref_conso'] ."';";
			mysql_query($sql_stock)or die($sql_stock);
				
		}
	
	}
	else if(isset($_POST['suppr']))
	{
		$sql_livrer = "SELECT * FROM LIVRER WHERE NUM_LIVRAISON = '" .$_POST['num_livr'] ."' AND REFERENCE = '" .$_POST['ref_conso'] ."';";
		$res_l = mysql_query($sql_livrer);
		$livrer = mysql_fetch_array($res_l);
	
		$sql_stock = "UPDATE CONSOMMABLE
					  SET QTE_STOCK = QTE_STOCK - " .$livrer['QTE_LIVRE'] ." 
					  WHERE REFERENCE = '" .$_POST['ref_conso'] ."';";
		mysql_query($sql_stock)or die($sql_stock);
	
		$sql_del = "DELETE FROM LIVRER WHERE NUM_LIVRAISON = '" .$_POST['num_livr'] ."' AND REFERENCE = '" .$_POST['ref_conso'] ."';";
		mysql_query($sql_del)or die('Delete conso:' .$sql_del);
				
	}
	else if(isset($_POST['maj_qte']))
	{
		$sql_livrer = "SELECT * FROM LIVRER WHERE NUM_LIVRAISON = '" .$_POST['num_livr'] ."' AND REFERENCE = '" .$_POST['ref_conso'] ."';";
		$res_l = mysql_query($sql_livrer);
		$livrer = mysql_fetch_array($res_l);
		
		if($_POST['maj_qte'] < $livrer['QTE_LIVRE'])
		{
			$st = $livrer['QTE_LIVRE'] - $_POST['maj_qte'];
			$sql_stock = "UPDATE CONSOMMABLE
						  SET QTE_STOCK = QTE_STOCK - " .$st ."  
						  WHERE REFERENCE = '" .$_POST['ref_conso'] ."';";
			mysql_query($sql_stock)or die($sql_stock);
		}
		else
		{
			$st = $_POST['maj_qte'] - $livrer['QTE_LIVRE'];
			$sql_stock = "UPDATE CONSOMMABLE
						  SET QTE_STOCK = QTE_STOCK + " .$st ."  
						  WHERE REFERENCE = '" .$_POST['ref_conso'] ."';";
			mysql_query($sql_stock)or die($sql_stock);
		
		}
				
		$sql_up = "UPDATE LIVRER
				   SET QTE_LIVRE = " .$_POST['maj_qte'] ." "
				 ."WHERE REFERENCE = '" .$_POST['ref_conso'] ."' AND NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
		mysql_query($sql_up)or die('Modif qte:' .$sql_up);
	
	}
	else if(isset($_POST['maj_num_livr']))
	{
		$sql_up = "UPDATE LIVRAISON
				   SET NUM_LIVRAISON = '" .$_POST['maj_num_livr'] ."' 
				   WHERE NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
		mysql_query($sql_up)or die('Maj Num_livr:' .$sql_up);
		
		$sql_up_l = "UPDATE LIVRER
					 SET NUM_LIVRAISON = '" .$_POST['maj_num_livr'] ."' 
					 WHERE NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
		mysql_query($sql_up_l)or die('Maj livrer:' .$sql_up_l);
		
		$sql_up_r = "UPDATE RECEVOIR
					 SET NUM_LIVRAISON = '" .$_POST['maj_num_livr'] ."' 
					 WHERE NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
		mysql_query($sql_up_r)or die('Maj recevoir:' .$sql_up_r);
				
		$aff = false;
	
	}
	else if(isset($_POST['maj_date_livr']))
	{
		$t_d = split('/', $_POST['maj_date_livr']);
									
		$sql_up = "UPDATE LIVRAISON
				   SET DATE_LIVRAISON = '" .$t_d[2] ."-" .$t_d[1] ."-" .$t_d[0] ."' 
				   WHERE NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
		mysql_query($sql_up)or die('Maj Date_livr:' .$sql_up);
		
		$aff = false;
	
	}
	/*else if(isset($_POST['maj_num_com_livr']))
	{
		if($_POST['maj_num_com_livr'] == 'Aucune')
		{
			$sql_del = "DELETE FROM RECEVOIR
					    WHERE NUM_COMMANDE = '" .$_POST['num_com_livr'] ."'
					    AND NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
			mysql_query($sql_del)or die('Delete recevoir:' .$sql_del);
		
		}
		else
		{
			$sql_r = "SELECT * FROM RECEVOIR
					  WHERE NUM_COMMANDE = '" .$_POST['num_com_livr'] ."'
					  AND NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
					  
			$res_r = mysql_query($sql_r);
			if(mysql_num_rows($res_r) > 0)
			{
		
				$sql_up = "UPDATE RECEVOIR
						   SET NUM_COMMANDE = '" .$_POST['maj_num_com_livr'] ."'
						   WHERE NUM_COMMANDE = '" .$_POST['num_com_livr'] ."'
						   AND NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
				mysql_query($sql_up)or die('Maj num com:' .$sql_up);
			}
			else
			{
				$sql_ins = "INSERT INTO RECEVOIR VALUES('" .$_POST['maj_num_com_livr'] ."', '" .$_POST['num_livr'] ."');";
				mysql_query($sql_ins)or die('Insertion recevoir:' .$sql_ins);
				
			
			}
			
		}
		
		$aff = false;
	
	}*/
	
	
	if($aff)
	{
	
		$res_l = mysql_query($sql_conso_livr)or die($sql_conso_livr);
		
		if(mysql_num_rows($res_l) > 0)
		{


?>
		
			<form action="<?php if(isset($_GET['redirection']))echo $_GET['redirection'];else echo 'liste_livraison.php'; ?>" method="post">
			<table class="tab_commande" id="id_tab_livr">
			<tr>
				<td class="titre_fond_bleu25" valign="top" colspan="7">
					Consommables de votre livraison
				</td>
			</tr>
			
			<tr>
				<td class="cell_ref_com">Reference</td>
				<td class="cell_des_com">Designation</td>
				<td class="cell_qte_com">Qte Com</td>
				<td class="cell_livre_com">Qte Livre</td>
				<td class="cell_pu_com">PU</td>
				<td class="cell_ptot_com">Prix Tot</td>
				<td class="cell_suppr_com">S</td>
			</tr>

<?php

			$total = 0;
			$total_tva = 0;$i=1;
			while($conso = mysql_fetch_array($res_l))
			{
							
				echo '<tr>';
				echo '<td>' .$conso['REFERENCE'] .'</td>';
				echo '<td>' .$conso['DESIGNATION'] .'</td>';
				
				$sql_conso = "SELECT *
							  FROM CONSOMMABLE AS C, CONTENIR AS CONT
							  WHERE C.REFERENCE = CONT.REFERENCE
							  AND CONT.NUM_COMMANDE = '" .$num_c_l['NUM_COMMANDE'] ."'
							  AND C.REFERENCE = '" .$conso['REFERENCE'] ."';";
				$res_conso = mysql_query($sql_conso);
				$conso_com = mysql_fetch_array($res_conso);
				echo '<td align="center">' .$conso_com['QTE_COMMANDER'] .'</td>';
				
				echo '<td>';
				echo '<select class="text_60" id="qte_' .$i .'" onchange="Valider_quantite_livr_modif(' .$i .", '" .$conso['NUM_LIVRAISON'] ."','" .$conso['REFERENCE'] ."');" .'"' .'>';
				for($j = 1;$j <= $conso_com['QTE_COMMANDER'];$j++)
				{
					if($conso['QTE_LIVRE'] == $j)
					{
						echo '<option value="' .$j .'" selected="selected">' .$j .'</option>';
					}
					else
					{
						echo '<option value="' .$j .'">' .$j .'</option>';
					}
					
				}
				echo '</select>';
				echo '</td>';
				
				echo '<td align="center">' .round($conso['PRIX_CONSO'], 2) .'&#8364;</td>';
				echo '<td align="center">' .($conso['QTE_LIVRE'] * round($conso['PRIX_CONSO'], 2)) .'&#8364;</td>';
				echo '<td><img src="Image/suppr.gif" alt="Supprimer le consommable de la demande" onclick="Retirer_conso_livraison_modif(' ."'" .$conso['NUM_LIVRAISON'] ."','" .$conso['REFERENCE'] ."'" .');" /></td>';
				echo '</tr>';
				
				$sql_tva = "SELECT * FROM TVA WHERE CODE_TVA = " .$conso['CODE_TVA'];
				$res_tva = mysql_query($sql_tva);
				$tva = mysql_fetch_array($res_tva);
				
				$total_tva += round((($conso['PRIX_CONSO'] * $conso['QTE_LIVRE']) * $tva['TAUX_TVA']) / 100, 2);
				$total += ($conso['QTE_LIVRE'] * round($conso['PRIX_CONSO'], 2));
				
				$i++;
			
			}
			
			echo '<tr><td colspan="3" align="right" class="cell_total">Total TVA</td><td colspan="4" align="center" class="cell_total_p">' .$total_tva .'&#8364;</td></tr>';
			echo '<tr><td colspan="3" align="right" >Total TTC</td><td colspan="4" align="center" class="cell_total_p">' .$total .'&#8364;</td></tr>';
			


?>
	
			<tr>
				<td class="titre_fond_bleu25" colspan="7">
					<input type="button" name="valider" id="b_valider_com" value="Supprimer la livraison" class="bouton_blanc12" onclick="Supprimer_livraison();"/>
					<input type="submit" name="retour" value="Retour" class="bouton_blanc12"/>
					
				</td>
			</tr>

			</table>
			</form>
			<input type="hidden" id="val_dem" value="oui" />
			
			<form action="liste_livraison.php?retour=retour" method="post" id="form_retour">
			</form>
		
		
		
<?php

		}

	}


?>
		
		
		
		