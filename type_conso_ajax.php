<?php


	if(isset($_POST['ajax']))
	{
		header('Content-Type: text/html; charset=ISO-8859-1'); 
		include('connect.php');
	}
	
	if(isset($_POST['type_conso']))
	{
		$sql_ins_tp = "INSERT INTO TYPE_CONSO VALUES(NULL, '" .utf8_decode($_POST['type_conso']) ."');";
		mysql_query($sql_ins_tp)or die($sql_ins_tp);
			
	}
	else if(isset($_POST['suppr']))
	{
		$sql_del = "DELETE FROM TYPE_CONSO WHERE ID_TYPE = " .$_POST['id_type'];
		mysql_query($sql_del)or die($sql_del);
	
	}
	else if(isset($_POST['modif']))
	{
		$sql_up = "UPDATE TYPE_CONSO 
				   SET LIBELLE_TYPE = '" .$_POST['nv_type_conso'] ."' 
				   WHERE ID_TYPE = " .$_POST['id_type'];
		mysql_query($sql_up)or die($sql_up);
	
	}
	

	$sql_tp = "SELECT * FROM TYPE_CONSO ORDER BY LIBELLE_TYPE;";
	$res_t = mysql_query($sql_tp);
	
	if(mysql_num_rows($res_t) > 0)
	{
?>

		<table class="tab_bleu_375">
			<tr>
				<td>
					<input type="checkbox" name="modifier_check" id="modifier_check" value="" />
					Modifier les types de consommables
				</td>
			</tr>
			<tr>
				<td class="titre_fond_bleu25" valign="top" colspan="2">
					Type de consommable
				</td>
			</tr>
			<tr>
				<td class="cell_360">Type de consommable</td>
				<td class="cell_15">S</td>
			</tr>
			
<?php
		
		$i = 0;
		while($tp = mysql_fetch_array($res_t))
		{
			echo '<tr>';
			echo '<td><input type="text" class="text_350" maxlength="75" name="tp_conso' .$i .'" id="tp_conso' .$i .'" value="' .$tp['LIBELLE_TYPE'] .'" onblur="Modifier_type_conso(' .$i .', ' .$tp['ID_TYPE'] .');"/></td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer le type de consommable" onclick="Supprimer_type_conso(' .$tp['ID_TYPE'] .');" /></td>';
			echo '</tr>';
			echo '<input type="hidden" name="tp_conso' .$i .'h" id="tp_conso' .$i .'h" value="' .$tp['LIBELLE_TYPE'] .'"/>';
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