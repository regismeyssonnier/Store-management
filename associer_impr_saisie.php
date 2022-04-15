<?php

	if(isset($_POST['ajax']))
	{
		session_start();
	
		include ('connect.php');
		
	}
	
	if(!isset($_SESSION['index_tab_saisie_impr']))
	{
		$_SESSION['index_tab_saisie_impr'] = 0;
		$_SESSION['tab_article_saisie_impr'] = array();
		$_SESSION['tab_annee_article_saisie_impr'] = array();
			
	}
	
	if(isset($_POST['id_service']))
	{
		$_SESSION['tab_article_saisie_impr'][$_SESSION['index_tab_saisie_impr']] = $_POST['id_service'];
		$_SESSION['tab_annee_article_saisie_impr'][$_SESSION['index_tab_saisie_impr']] = date('Y');
		$_SESSION['index_tab_saisie_impr']++;
			
	}
	else if(isset($_POST['ind']))
	{
		
		for($j = $_POST['ind'];$j < ($_SESSION['index_tab_saisie_impr'] - 1);$j++)
		{
			$_SESSION['tab_article_saisie_impr'][$j] = $_SESSION['tab_article_saisie_impr'][$j+1];
			$_SESSION['tab_annee_article_saisie_impr'][$j] = $_SESSION['tab_annee_article_saisie_impr'][$j+1];
			
		}
		
		$_SESSION['index_tab_saisie_impr']--;
			
		
	}
	else if(isset($_POST['maj_annee']))
	{
		$_SESSION['tab_annee_article_saisie_impr'][$_POST['i']] = $_POST['maj_annee'];
	
	}
	

	if($_SESSION['index_tab_saisie_impr'] > 0) 
	{


?>

		<table class="tab_ass_conso">
		<tr>
			<td class="cell_242">Division</td>
			<td class="cell_243">Service</td>
			<td class="cell_75">Annee</td>
			<td class="cell_15">S</td>
		</tr>

<?php

		for($i = 0;$i < $_SESSION['index_tab_saisie_impr'];$i++)
		{
			$sql_ds = "SELECT * FROM DIVISION AS D, SERVICE AS S WHERE D.ID_DIVISION = S.ID_DIVISION AND S.ID_SERVICE ='" .$_SESSION['tab_article_saisie_impr'][$i] ."';";
			$res_ds = mysql_query($sql_ds);
			$ds = mysql_fetch_array($res_ds);
			
			echo '<tr>';
			echo '<td align="center">' .$ds['ID_DIVISION'] .'</td>';
			echo '<td align="center">' .$ds['ID_SERVICE'] .'</td>';
			echo '<td><input type="text" name="qte" value="' .$_SESSION['tab_annee_article_saisie_impr'][$i] .'" class="text_75" id="annee_' .$i .'" onblur="Valider_annee(' .$i .');" /></td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer le service" onclick="Retirer_ass_service(' .$i .');" /></td>';
			echo '</tr>';
		
		
		}
		
		echo '</table>';
		

	}


?>
		
		
		
		