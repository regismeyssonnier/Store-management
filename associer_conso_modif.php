<?php

	$num_conso = '';
	if(isset($_POST['ajax']))
	{
		session_start();
	
		include ('connect.php');
		
		$sql_impr = "SELECT *
					  FROM IMPRIMANTE AS I, ASSOCIER AS A
					  WHERE I.REF_IMPRIMANTE = A.REF_IMPRIMANTE
					  AND A.REFERENCE = '" .$_POST['num_conso'] ."';";
					  
		$num_conso = $_POST['num_conso'];
		
	}
	else
	{
		$sql_impr = "SELECT *
					  FROM IMPRIMANTE AS I, ASSOCIER AS A
					  WHERE I.REF_IMPRIMANTE = A.REF_IMPRIMANTE
					  AND A.REFERENCE = '" .$_GET['num_conso'] ."';";
					  
		$num_conso = $_GET['num_conso'];
	
	}
	
		
	if(isset($_POST['ass_conso']))
	{
		$sql_ins_ass = "INSERT INTO ASSOCIER VALUES('" .$_POST['num_conso'] ."', '" .$_POST['ass_conso'] ."');";
		mysql_query($sql_ins_ass);
				
	}
	else if(isset($_POST['supp_ass_conso']))
	{
		$sql_del_ass = "DELETE FROM ASSOCIER WHERE REFERENCE = '" .$_POST['num_conso'] ."' AND REF_IMPRIMANTE = '" .$_POST['supp_ass_conso'] ."';";
		mysql_query($sql_del_ass) or die($sql_del_ass);
		
	}
	

	
	$res_a = mysql_query($sql_impr);
	if(mysql_num_rows($res_a) > 0)
	{
				
		

?>

		<table class="tab_ass_conso">
		<tr>
			<td class="cell_75">Reference</td>
			<td class="cell_485">Designation</td>
			<td class="cell_15">S</td>
		</tr>

<?php

		while($impr = mysql_fetch_array($res_a))
		{
					
			echo '<tr>';
			echo '<td>' .$impr['REF_IMPRIMANTE'] .'</td>';
			echo '<td>' .$impr['DESIGNATION_IMPRIMANTE'] .'</td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer l imprimante de l association" onclick="Retirer_ass_modif(' ."'" .$num_conso ."', '" .$impr['REF_IMPRIMANTE'] ."'" .');" /></td>';
			echo '</tr>';
		
		
		}
		
		echo '</table>';
		

	}


?>
		
		
		
		