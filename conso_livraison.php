<?php

	if(isset($_POST['ajax']))
	{
		session_start();
	
		include ('connect.php');
		
	}
	
	if(!isset($_SESSION['index_tab_l']))
	{
		$_SESSION['index_tab_l'] = 0;
		$_SESSION['tab_article_l'] = array();
		$_SESSION['tab_nb_article_l'] = array();
		$_SESSION['num_com'] = '';
	
	}
	
	if(isset($_POST['ref_conso']))
	{
		$trouver = false;
		for($i = 0;$i < $_SESSION['index_tab_l'];$i++)
		{
			if($_SESSION['tab_article_l'][$i] == $_POST['ref_conso'])
			{
				$sql_conso = "SELECT *
							  FROM CONSOMMABLE AS C, CONTENIR AS CONT
							  WHERE C.REFERENCE = CONT.REFERENCE
							  AND CONT.NUM_COMMANDE = '" .$_SESSION['num_com'] ."'
							  AND C.REFERENCE = '" .$_SESSION['tab_article_l'][$i] ."';";
				$res_conso = mysql_query($sql_conso);
				$conso_com = mysql_fetch_array($res_conso);
				
				if($_SESSION['tab_nb_article_l'][$i]  < $conso_com['QTE_COMMANDER'])
				{
					$_SESSION['tab_nb_article_l'][$i]++;
					
				}
				$trouver = true;
				break;
			}
		
		}
		
		if(!$trouver)
		{
			$_SESSION['tab_article_l'][$_SESSION['index_tab_l']] = $_POST['ref_conso'];
			$_SESSION['tab_nb_article_l'][$_SESSION['index_tab_l']] = 1;
			$_SESSION['index_tab_l']++;
		}
		$_SESSION['num_com'] = $_POST['num_com'];
			
	}
	else if(isset($_POST['ind']))
	{
		
		for($j = $_POST['ind'];$j < ($_SESSION['index_tab_l'] - 1);$j++)
		{
			$_SESSION['tab_article_l'][$j] = $_SESSION['tab_article_l'][$j+1];
			$_SESSION['tab_nb_article_l'][$j] = $_SESSION['tab_nb_article_l'][$j+1];
		}
		
		$_SESSION['index_tab_l']--;
			
		
	}
	else if(isset($_POST['num_livr']))
	{
		$t_d = split('/', $_POST['date_livr']);
		$sql_ins_com = "INSERT INTO LIVRAISON VALUES('" .$_POST['num_livr'] ."', '" .$t_d[2]."-".$t_d[1]."-".$t_d[0] ."', " .$_SESSION['id_util'] .");";
		mysql_query($sql_ins_com);
		
		$sql_rec = "INSERT INTO RECEVOIR VALUES('" .$_POST['num_com_livr'] ."', '" .$_POST['num_livr'] ."');";
		mysql_query($sql_rec);
					
		for($i = 0;$i < $_SESSION['index_tab_l'];$i++)
		{
			$sql_prix = "SELECT PRIX_UNITAIRE FROM CONSOMMABLE WHERE REFERENCE = '" .$_SESSION['tab_article_l'][$i] ."';";
			$res_p = mysql_query($sql_prix);
			$prix = mysql_fetch_array($res_p);
			
			$sql_ins_l = "INSERT INTO LIVRER VALUES('" .$_POST['num_livr'] ."', '" .$_SESSION['tab_article_l'][$i] ."', " .$_SESSION['tab_nb_article_l'][$i] .", " .$prix['PRIX_UNITAIRE'] .");";
			mysql_query($sql_ins_l) or die($sql_ins_l);
			
			$sql_stock = "UPDATE CONSOMMABLE
						  SET QTE_STOCK = QTE_STOCK + " .$_SESSION['tab_nb_article_l'][$i] ." 
						  WHERE REFERENCE = '" .$_SESSION['tab_article_l'][$i] ."';";
			mysql_query($sql_stock)or die($sql_stock);
		
		}
		
		
		$_SESSION['index_tab_l'] = 0;
		$_SESSION['tab_article_l'] = array();
		$_SESSION['tab_nb_article_l'] = array();
		$_SESSION['num_com'] = '';
		
		
	}
	else if(isset($_POST['maj_qte']))
	{
		$_SESSION['tab_nb_article_l'][$_POST['i']] = $_POST['maj_qte'];
	
	}
	else if(isset($_POST['raz']))
	{
		$_SESSION['index_tab_l'] = 0;
		$_SESSION['tab_article_l'] = array();
		$_SESSION['tab_nb_article_l'] = array();
		$_SESSION['num_com'] = '';
	
	}

	if($_SESSION['index_tab_l'] > 0)
	{


?>

		<table class="tab_commande" id="id_tab_livr">
		<tr>
			<td class="titre_fond_bleu25" valign="top" colspan="7">
				Consommables de votre commande
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
		$total_tva = 0;
		for($i = 0;$i < $_SESSION['index_tab_l'];$i++)
		{
			$sql_c = "SELECT * FROM CONSOMMABLE WHERE REFERENCE ='" .$_SESSION['tab_article_l'][$i] ."';";
			$res_c = mysql_query($sql_c);
			$conso = mysql_fetch_array($res_c);
			
			echo '<tr>';
			echo '<td>' .$_SESSION['tab_article_l'][$i] .'</td>';
			echo '<td>' .$conso['DESIGNATION'] .'</td>';
			
			$sql_conso = "SELECT *
						  FROM CONSOMMABLE AS C, CONTENIR AS CONT
						  WHERE C.REFERENCE = CONT.REFERENCE
						  AND CONT.NUM_COMMANDE = '" .$_SESSION['num_com'] ."'
						  AND C.REFERENCE = '" .$conso['REFERENCE'] ."';";
			$res_conso = mysql_query($sql_conso);
			$conso_com = mysql_fetch_array($res_conso);
			echo '<td align="center">' .$conso_com['QTE_COMMANDER'] .'</td>';
					  
			echo '<td>';
			echo '<select class="text_60" id="qte_' .$i .'" onchange="Valider_quantite_com_livr(' .$i .");" .'"' .'>';
			for($j = 1;$j <= $conso_com['QTE_COMMANDER'];$j++)
			{
				if(isset($_SESSION['tab_nb_article_l']))
				{
					if($_SESSION['tab_nb_article_l'][$i] == $j)
					{
						echo '<option value="' .$j .'" selected="selected">' .$j .'</option>';
					}
					else
					{
						echo '<option value="' .$j .'">' .$j .'</option>';
					}
				}
				else
				{
					echo '<option value="' .$j .'">' .$j .'</option>';
				}
			}
			echo '</select>';
			echo '</td>';
			
			echo '<td align="center">' .round($conso['PRIX_UNITAIRE'], 2) .'&#8364;</td>';
			echo '<td align="center">' .($_SESSION['tab_nb_article_l'][$i] * round($conso['PRIX_UNITAIRE'], 2)) .'&#8364;</td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer le consommable de la demande" onclick="Retirer_conso_livraison(' .$i .');" /></td>';
			echo '</tr>';
			
			$sql_tva = "SELECT * FROM TVA WHERE CODE_TVA = " .$conso['CODE_TVA'];
			$res_tva = mysql_query($sql_tva);
			$tva = mysql_fetch_array($res_tva);
			
			$total_tva += round((($conso['PRIX_UNITAIRE'] * $_SESSION['tab_nb_article_l'][$i]) * $tva['TAUX_TVA']) / 100, 2);
			$total += ($_SESSION['tab_nb_article_l'][$i] * round($conso['PRIX_UNITAIRE'], 2));
		
		}
		
		echo '<tr><td colspan="3" align="right" class="cell_total">Total TVA</td><td colspan="4" align="center" class="cell_total_p">' .$total_tva .'&#8364;</td></tr>';
		echo '<tr><td colspan="3" align="right" >Total TTC</td><td colspan="4" align="center" class="cell_total_p">' .$total .'&#8364;</td></tr>';
		


?>
	
		<tr>
			<td class="titre_fond_bleu25" colspan="7">
				<input type="button" name="valider" id="b_valider_com" value="Valider la livraison" class="bouton_blanc12" onclick="Valider_livraison();"/>
				
			</td>
		</tr>

		</table>
		<input type="hidden" id="val_dem" value="oui" />
		
		
		
		
<?php

	}


?>
		
		
		
		