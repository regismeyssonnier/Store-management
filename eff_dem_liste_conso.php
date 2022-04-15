<?php

	if(isset($_POST['ajax']))
	{
		session_start();
	
		include ('connect.php');
		
	}
	
	if(!isset($_SESSION['index_tab']))
	{
		$_SESSION['index_tab'] = 0;
		$_SESSION['tab_article'] = array();
		$_SESSION['tab_nb_article'] = array();
	
	}
	
	if(isset($_POST['ref_conso']))
	{
		$trouver = false;
		for($i = 0;$i < $_SESSION['index_tab'];$i++)
		{
			if($_SESSION['tab_article'][$i] == $_POST['ref_conso'])
			{
				$_SESSION['tab_nb_article'][$i]++;
				$trouver = true;
				break;
			}
		
		}
		
		if(!$trouver)
		{
			$_SESSION['tab_article'][$_SESSION['index_tab']] = $_POST['ref_conso'];
			$_SESSION['tab_nb_article'][$_SESSION['index_tab']] = 1;
			$_SESSION['index_tab']++;
		}
	
	
	}
	else if(isset($_POST['ind']))
	{
		
		for($j = $_POST['ind'];$j < ($_SESSION['index_tab'] - 1);$j++)
		{
			$_SESSION['tab_article'][$j] = $_SESSION['tab_article'][$j+1];
			$_SESSION['tab_nb_article'][$j] = $_SESSION['tab_nb_article'][$j+1];
		}
		
		$_SESSION['index_tab']--;
			
		
	}
	else if(isset($_POST['validation']))
	{
		$sql_num_dem = "SELECT MAX(NUM_DEMANDE) FROM DEMANDE;";
		$res_n = mysql_query($sql_num_dem);
		$num = mysql_fetch_array($res_n);
		$num_dem = $num[0] + 1;
		
		$sql_num_demc = "SELECT MAX(NUM_DEMANDE) FROM CONSOMMER;";
		$res_nc = mysql_query($sql_num_demc);
		$numc = mysql_fetch_array($res_nc);
		$num_demc = $numc[0] + 1;
		
		if($num_demc > $num_dem)
			$num_dem = $num_demc;
		
		$sql_etat_att = "SELECT NUM_ETAT FROM ETAT WHERE LIBELLE_ETAT = 'en attente';";
		$res_ne = mysql_query($sql_etat_att);
		$num_ne = mysql_fetch_array($res_ne);
		$num_etat = $num_ne[0];
		
		$sql_ins_dem = "INSERT INTO DEMANDE VALUES(" .$num_dem .", CURDATE(), NULL," .$_SESSION['id_util'] .");";
		mysql_query($sql_ins_dem) or die("Erreur req demande");
		
		$sql_ins_etat = "INSERT INTO POSSEDER VALUES(" .$num_dem .", " .$num_etat .", CURDATE() );";
		mysql_query($sql_ins_etat) or die("Erreur req posseder" .$sql_ins_etat);
		
		for($i = 0;$i < $_SESSION['index_tab'];$i++)
		{
			$sql_prix = "SELECT PRIX_UNITAIRE FROM CONSOMMABLE WHERE REFERENCE = '" .$_SESSION['tab_article'][$i] ."';";
			$res_p = mysql_query($sql_prix);
			$prix = mysql_fetch_array($res_p);
			
			$sql_ins_d = "INSERT INTO DEMANDER VALUES(" .$num_dem .", '" .$_SESSION['tab_article'][$i] ."', " .$_SESSION['tab_nb_article'][$i] .", " .$prix['PRIX_UNITAIRE'] .");";
			mysql_query($sql_ins_d) or die($sql_ins_d);
		
		}
		
		
		$_SESSION['index_tab'] = 0;
		$_SESSION['tab_article'] = array();
		$_SESSION['tab_nb_article'] = array();
		
		
	}
	else if(isset($_POST['maj_qte']))
	{
		$_SESSION['tab_nb_article'][$_POST['i']] = $_POST['maj_qte'];
	
	}

	if( ($_SESSION['index_tab'] > 0) && (!isset($_POST['maj_qte'])) )
	{


?>

		<table class="tab_bleu_575" id="id_tab_dem">
		<tr>
			<td class="titre_fond_bleu25" valign="top" colspan="4">
				Consommable de votre demande
			</td>
		</tr>
		
		<tr>
			<td class="cell_75">Reference</td>
			<td class="cell_410">Designation</td>
			<td class="cell_75">Quantite</td>
			<td class="cell_15">S</td>
		</tr>

<?php

		for($i = 0;$i < $_SESSION['index_tab'];$i++)
		{
			$sql_c = "SELECT * FROM CONSOMMABLE WHERE REFERENCE ='" .$_SESSION['tab_article'][$i] ."';";
			$res_c = mysql_query($sql_c);
			$conso = mysql_fetch_array($res_c);
			
			echo '<tr>';
			echo '<td>' .$_SESSION['tab_article'][$i] .'</td>';
			echo '<td>' .$conso['DESIGNATION'] .'</td>';
			echo '<td><input type="text" name="qte" value="' .$_SESSION['tab_nb_article'][$i] .'" class="text_75" id="qte_' .$i .'" onblur="Valider_quantite(' .$i .");" .'"' .'/></td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer le consommable de la demande" onclick="Retirer_conso(' .$i .');" /></td>';
			echo '</tr>';
		
		
		}


?>
	
		<tr>
			<td class="titre_fond_bleu25" colspan="4">
				<input type="button" name="valider" id="b_valider_dem" value="Valider la demande" class="bouton_blanc12" onclick="Valider_demande();"/>
				
			</td>
		</tr>
		
		</table>
		<input type="hidden" id="val_dem" value="oui" />
		
<?php

	}


?>
		
		
		
		