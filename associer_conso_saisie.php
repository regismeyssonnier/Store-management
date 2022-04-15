<?php

	if(isset($_POST['ajax']))
	{
		session_start();
	
		include ('connect.php');
		
	}
	
	if(!isset($_SESSION['index_tab_saisie']))
	{
		$_SESSION['index_tab_saisie'] = 0;
		$_SESSION['tab_article_saisie'] = array();
			
	}
	
	if(isset($_POST['ref_impr']))
	{
		$trouver = false;
		for($i = 0;$i < $_SESSION['index_tab_saisie'];$i++)
		{
			if($_SESSION['tab_article_saisie'][$i] == $_POST['ref_impr'])
			{
				$trouver = true;
				break;
			}
		
		}
		
		if(!$trouver)
		{
			$_SESSION['tab_article_saisie'][$_SESSION['index_tab_saisie']] = $_POST['ref_impr'];
			$_SESSION['index_tab_saisie']++;
		}
	
	
	}
	else if(isset($_POST['ind']))
	{
		
		for($j = $_POST['ind'];$j < ($_SESSION['index_tab_saisie'] - 1);$j++)
		{
			$_SESSION['tab_article_saisie'][$j] = $_SESSION['tab_article_saisie'][$j+1];
			
		}
		
		$_SESSION['index_tab_saisie']--;
			
		
	}
	

	if($_SESSION['index_tab_saisie'] > 0) 
	{


?>

		<table class="tab_ass_conso">
		<tr>
			<td class="cell_75">Reference</td>
			<td class="cell_485">Designation</td>
			<td class="cell_15">S</td>
		</tr>

<?php

		for($i = 0;$i < $_SESSION['index_tab_saisie'];$i++)
		{
			$sql_i = "SELECT * FROM IMPRIMANTE WHERE REF_IMPRIMANTE ='" .$_SESSION['tab_article_saisie'][$i] ."';";
			$res_i = mysql_query($sql_i);
			$impr = mysql_fetch_array($res_i);
			
			echo '<tr>';
			echo '<td>' .$_SESSION['tab_article_saisie'][$i] .'</td>';
			echo '<td>' .$impr['DESIGNATION_IMPRIMANTE'] .'</td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer l imprimante" onclick="Retirer_ass_saisie(' .$i .');" /></td>';
			echo '</tr>';
		
		
		}
		
		echo '</table>';
		

	}


?>
		
		
		
		