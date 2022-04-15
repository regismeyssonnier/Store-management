<?php

	if(isset($_POST['ajax']))
	{
		include('connect.php');
	}
	
	if(isset($_POST['taux_tva']))
	{
		$sql_ins_tva = "INSERT INTO TVA VALUES(NULL, " .$_POST['taux_tva'] .");";
		mysql_query($sql_ins_tva)or die($sql_ins_tva);
			
	}
	else if(isset($_POST['suppr']))
	{
		$sql_del = "DELETE FROM TVA WHERE CODE_TVA = " .$_POST['code_tva'];
		mysql_query($sql_del)or die($sql_del);
	
	}
	else if(isset($_POST['modif']))
	{
		$sql_up = "UPDATE TVA 
				   SET TAUX_TVA = " .$_POST['nv_taux_tva'] ." 
				   WHERE CODE_TVA = " .$_POST['code_tva'];
		mysql_query($sql_up)or die($sql_up);
	
	}
	

	$sql_tva = "SELECT * FROM TVA ORDER BY TAUX_TVA;";
	$res_t = mysql_query($sql_tva);
	
	if(mysql_num_rows($res_t) > 0)
	{
?>

		<table class="tab_bleu_115">
			<tr>
				<td>
					<input type="checkbox" name="modifier_check" id="modifier_check" value="" />
					Modifier TVA
				</td>
			</tr>
			<tr>
				<td class="titre_fond_bleu25" valign="top" colspan="2">
					Taux de TVA
				</td>
			</tr>
			<tr>
				<td class="cell_100">Taux TVA</td>
				<td class="cell_15">S</td>
			</tr>
			
<?php
		
		$i = 0;
		while($tva = mysql_fetch_array($res_t))
		{
			echo '<tr>';
			echo '<td><input type="text" class="text_100" name="taux_tva' .$i .'" id="taux_tva' .$i .'" value="' .$tva['TAUX_TVA'] .'" onblur="Modifier_tva(' .$i .', ' .$tva['CODE_TVA'] .');"/></td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer le taux de tva" onclick="Supprimer_taux_tva(' .$tva['CODE_TVA'] .');" />';
			echo '</tr>';
			echo '<input type="hidden" name="taux_tva' .$i .'h" id="taux_tva' .$i .'h" value="' .$tva['TAUX_TVA'] .'"/>';
			$i++;
		
		}
		
?>

		<tr>
			<td class="titre_fond_bleu25" valign="top" colspan="2">
				
			</td>
		</tr>
		</table>


<?php
		
	}

?>