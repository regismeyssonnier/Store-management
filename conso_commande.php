<?php

	if(isset($_POST['ajax']))
	{
		session_start();
	
		include ('connect.php');
		
	}
	
	if(!isset($_SESSION['index_tab_c']))
	{
		$_SESSION['index_tab_c'] = 0;
		$_SESSION['tab_article_c'] = array();
		$_SESSION['tab_nb_article_c'] = array();
	
	}
	
	if(isset($_POST['ref_conso']))
	{
		$trouver = false;
		for($i = 0;$i < $_SESSION['index_tab_c'];$i++)
		{
			if($_SESSION['tab_article_c'][$i] == $_POST['ref_conso'])
			{
				$_SESSION['tab_nb_article_c'][$i]++;
				$trouver = true;
				break;
			}
		
		}
		
		if(!$trouver)
		{
			$_SESSION['tab_article_c'][$_SESSION['index_tab_c']] = $_POST['ref_conso'];
			$_SESSION['tab_nb_article_c'][$_SESSION['index_tab_c']] = 1;
			$_SESSION['index_tab_c']++;
		}
	
	
	}
	else if(isset($_POST['ind']))
	{
		
		for($j = $_POST['ind'];$j < ($_SESSION['index_tab_c'] - 1);$j++)
		{
			$_SESSION['tab_article_c'][$j] = $_SESSION['tab_article_c'][$j+1];
			$_SESSION['tab_nb_article_c'][$j] = $_SESSION['tab_nb_article_c'][$j+1];
		}
		
		$_SESSION['index_tab_c']--;
			
		
	}
	else if(isset($_POST['num_com']))
	{
		$t_d = split('/', $_POST['date_com']);
		$sql_ins_com = "INSERT INTO COMMANDE VALUES('" .$_POST['num_com'] ."', '" .$t_d[2]."-".$t_d[1]."-".$t_d[0] ."', " .$_SESSION['id_util'] .");";
		mysql_query($sql_ins_com);
		
			
		for($i = 0;$i < $_SESSION['index_tab_c'];$i++)
		{
			$sql_prix = "SELECT PRIX_UNITAIRE FROM CONSOMMABLE WHERE REFERENCE = '" .$_SESSION['tab_article_c'][$i] ."';";
			$res_p = mysql_query($sql_prix);
			$prix = mysql_fetch_array($res_p);
			
			$sql_ins_c = "INSERT INTO CONTENIR VALUES('" .$_POST['num_com'] ."', '" .$_SESSION['tab_article_c'][$i] ."', " .$_SESSION['tab_nb_article_c'][$i] .", " .$prix['PRIX_UNITAIRE'] .");";
			mysql_query($sql_ins_c) or die($sql_ins_c);
		
		}
		
		
		$_SESSION['index_tab_c'] = 0;
		$_SESSION['tab_article_c'] = array();
		$_SESSION['tab_nb_article_c'] = array();
		
		
	}
	else if(isset($_POST['maj_qte']))
	{
		$_SESSION['tab_nb_article_c'][$_POST['i']] = $_POST['maj_qte'];
	
	}

	if($_SESSION['index_tab_c'] > 0)
	{


?>

		<table class="tab_commande" id="id_tab_com">
		<tr>
			<td class="titre_fond_bleu25" valign="top" colspan="6">
				Consommables de votre commande
			</td>
		</tr>
		
		<tr>
			<td class="cell_ref_com">Reference</td>
			<td class="cell_des_com">Designation</td>
			<td class="cell_qte_com">Qte</td>
			<td class="cell_pu_com">PU</td>
			<td class="cell_ptot_com">Prix Tot</td>
			<td class="cell_suppr_com">S</td>
		</tr>

<?php

		$total = 0;
		$total_tva = 0;
		for($i = 0;$i < $_SESSION['index_tab_c'];$i++)
		{
			$sql_c = "SELECT * FROM CONSOMMABLE WHERE REFERENCE ='" .$_SESSION['tab_article_c'][$i] ."';";
			$res_c = mysql_query($sql_c);
			$conso = mysql_fetch_array($res_c);
			
			echo '<tr>';
			echo '<td>' .$_SESSION['tab_article_c'][$i] .'</td>';
			echo '<td>' .$conso['DESIGNATION'] .'</td>';
			echo '<td><input type="text" name="qte" value="' .$_SESSION['tab_nb_article_c'][$i] .'" class="text_60" id="qte_' .$i .'" onblur="Valider_quantite_com(' .$i .");" .'"' .'/></td>';
			echo '<td align="center">' .round($conso['PRIX_UNITAIRE'], 2) .'&#8364;</td>';
			echo '<td align="center">' .($_SESSION['tab_nb_article_c'][$i] * round($conso['PRIX_UNITAIRE'], 2)) .'&#8364;</td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer le consommable de la demande" onclick="Retirer_conso_commande(' .$i .');" /></td>';
			echo '</tr>';
			
			$sql_tva = "SELECT * FROM TVA WHERE CODE_TVA = " .$conso['CODE_TVA'];
			$res_tva = mysql_query($sql_tva);
			$tva = mysql_fetch_array($res_tva);
			
			$total_tva += round((($conso['PRIX_UNITAIRE'] * $_SESSION['tab_nb_article_c'][$i]) * $tva['TAUX_TVA']) / 100, 2);
			$total += ($_SESSION['tab_nb_article_c'][$i] * round($conso['PRIX_UNITAIRE'], 2));
		
		}
		
		echo '<tr><td colspan="3" align="right" class="cell_total">Total TVA</td><td colspan="3" align="center" class="cell_total_p">' .$total_tva .'&#8364;</td></tr>';
		echo '<tr><td colspan="3" align="right" >Total TTC</td><td colspan="3" align="center" class="cell_total_p">' .$total .'&#8364;</td></tr>';
		


?>
	
		<tr>
			<td class="titre_fond_bleu25" colspan="6">
				<input type="button" name="valider" id="b_valider_com" value="Valider la commande" class="bouton_blanc12" onclick="Valider_commande();"/>
				
			</td>
		</tr>

		</table>
		<input type="hidden" id="val_dem" value="oui" />
		
		
		
		
<?php

	}


?>
		
		
		
		