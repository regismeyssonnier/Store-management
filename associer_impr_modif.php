<?php

	$ref_impr = '';
	if(isset($_POST['ajax']))
	{
		session_start();
	
		include ('connect.php');
		
		$sql_divs = "SELECT *
					 FROM SERVICE AS S, DIVISION AS D, IMPR_EN_SERVICE AS I
					 WHERE I.ID_SERVICE = S.ID_SERVICE
					 AND S.ID_DIVISION = D.ID_DIVISION
					 AND I.REF_IMPRIMANTE = '" .$_POST['ref_impr'] ."'
					 ORDER BY ANNEE_MISE_EN_SERVICE DESC, ID_IMPRIMANTE DESC;";
					 					  
		$ref_impr = $_POST['ref_impr'];
		
	}
	else
	{
		$sql_divs = "SELECT *
					 FROM SERVICE AS S, DIVISION AS D, IMPR_EN_SERVICE AS I
					 WHERE I.ID_SERVICE = S.ID_SERVICE
					 AND S.ID_DIVISION = D.ID_DIVISION
					 AND I.REF_IMPRIMANTE = '" .$_GET['ref_impr'] ."'
					 ORDER BY ANNEE_MISE_EN_SERVICE DESC, ID_IMPRIMANTE DESC;";
					  
		$ref_impr = $_GET['ref_impr'];
	
	}

	if(isset($_POST['id_service']))
	{
		$sql_impr_serv = "INSERT INTO IMPR_EN_SERVICE VALUES(NULL, '" .$_POST['ref_impr'] ."', '" .$_POST['id_service'] ."', " .date('Y') .");";
		mysql_query($sql_impr_serv)or die('Erreur ajout impr_en_service:' .$sql_impr_serv);
				
	}
	else if(isset($_POST['suppr_impr']))
	{
		$sql_del_serv = "DELETE FROM IMPR_EN_SERVICE WHERE ID_IMPRIMANTE = " .$_POST['suppr_impr'] .";";
		mysql_query($sql_del_serv) or die($sql_del_serv);
		
	}
	else if(isset($_POST['maj_annee']))
	{
		$sql_up_a = "UPDATE IMPR_EN_SERVICE
					 SET ANNEE_MISE_EN_SERVICE = " .$_POST['maj_annee'] ." "
				   ."WHERE ID_IMPRIMANTE = " .$_POST['id_impr'] .";";
		mysql_query($sql_up_a)or die($sql_up_a);
		
			
	}


	$res_d = mysql_query($sql_divs);
	if(mysql_num_rows($res_d) > 0)
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
		$i = 0;
		while($ds = mysql_fetch_array($res_d))
		{
			echo '<tr>';
			echo '<td align="center">' .$ds['ID_DIVISION'] .'</td>';
			echo '<td align="center">' .$ds['ID_SERVICE'] .'</td>';
			echo '<td><input type="text" name="annee_' .$i .'" value="' .$ds['ANNEE_MISE_EN_SERVICE'] .'" class="text_75" id="annee_' .$i .'" onblur="Valider_annee_modif(' .$i .',' .$ds['ID_IMPRIMANTE'] .');" /></td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer le service" onclick="Retirer_ass_service_modif(' .$ds['ID_IMPRIMANTE'] .');" /></td>';
			echo '</tr>';
			
			echo '<input type="hidden" name="h_annee_' .$i .'" value="' .$ds['ANNEE_MISE_EN_SERVICE'] .'" />';
			
			$i++;
		
		}
		
		echo '</table>';


	}




?>






