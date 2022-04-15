<?php

	if(isset($_POST['ajax']))
	{
		header('Content-Type: text/html; charset=ISO-8859-1'); 
		include('connect.php');
	}
	
	if(isset($_POST['type_impr']))
	{
		$sql_ins_tp = "INSERT INTO TYPE_IMPRIMANTE VALUES(NULL, '" .utf8_decode($_POST['type_impr']) ."');";
		mysql_query($sql_ins_tp)or die($sql_ins_tp);
			
	}
	else if(isset($_POST['suppr']))
	{
		$sql_del = "DELETE FROM TYPE_IMPRIMANTE WHERE ID_TYPE_IMPR = " .$_POST['id_type'];
		mysql_query($sql_del)or die($sql_del);
	
	}
	else if(isset($_POST['modif']))
	{
		$sql_up = "UPDATE TYPE_IMPRIMANTE 
				   SET LIB_TYPE_IMPR = '" .$_POST['nv_tp_impr'] ."' 
				   WHERE ID_TYPE_IMPR = " .$_POST['id_type'];
		mysql_query($sql_up)or die($sql_up);
	
	}
	

	$sql_tp = "SELECT * FROM TYPE_IMPRIMANTE ORDER BY LIB_TYPE_IMPR;";
	$res_t = mysql_query($sql_tp);
	
	if(mysql_num_rows($res_t) > 0)
	{
?>

		<table class="tab_bleu_375">
			<tr>
				<td>
					<input type="checkbox" name="modifier_check" id="modifier_check" value="" />
					Modifier les types d'imprimantes
				</td>
			</tr>
			<tr>
				<td class="titre_fond_bleu25" valign="top" colspan="2">
					Type d'imprimante
				</td>
			</tr>
			<tr>
				<td class="cell_360">Type d'imprimante</td>
				<td class="cell_15">S</td>
			</tr>
			
<?php
		
		$i = 0;
		while($tp = mysql_fetch_array($res_t))
		{
			echo '<tr>';
			echo '<td><input type="text" class="text_350" maxlength="75" name="tp_impr' .$i .'" id="tp_impr' .$i .'" value="' .$tp['LIB_TYPE_IMPR'] .'" onblur="Modifier_type_impr(' .$i .', ' .$tp['ID_TYPE_IMPR'] .');"/></td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer le type d\'imprimante" onclick="Supprimer_type_impr(' .$tp['ID_TYPE_IMPR'] .');" />';
			echo '</tr>';
			echo '<input type="hidden" name="tp_impr' .$i .'h" id="tp_impr' .$i .'h" value="' .$tp['LIB_TYPE_IMPR'] .'"/>';
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