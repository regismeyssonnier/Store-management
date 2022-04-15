<?php

	if(isset($_POST['ajax']))
	{
		header('Content-Type: text/html; charset=ISO-8859-1'); 
		include('connect.php');
	}
	
	if(isset($_POST['marque']))
	{
		$sql_ins = "INSERT INTO MARQUE VALUES(NULL, '" .utf8_decode($_POST['marque']) ."');";
		mysql_query($sql_ins)or die($sql_ins);
			
	}
	else if(isset($_POST['suppr']))
	{
		$sql_del = "DELETE FROM MARQUE WHERE ID_MARQUE = " .$_POST['id_marque'];
		mysql_query($sql_del)or die($sql_del);
	
	}
	else if(isset($_POST['modif']))
	{
		$sql_up = "UPDATE MARQUE 
				   SET LIBELLE_MARQUE = '" .$_POST['nv_marque'] ."' 
				   WHERE ID_MARQUE = " .$_POST['id_marque'];
		mysql_query($sql_up)or die($sql_up);
	
	}
	

	$sql_m = "SELECT * FROM MARQUE ORDER BY LIBELLE_MARQUE;";
	$res_m = mysql_query($sql_m);
	
	if(mysql_num_rows($res_m) > 0)
	{
?>

		<table class="tab_bleu_375">
			<tr>
				<td>
					<input type="checkbox" name="modifier_check" id="modifier_check" value="" />
					Modifier les marques
				</td>
			</tr>
			<tr>
				<td class="titre_fond_bleu25" valign="top" colspan="2">
					Marque d'imprimante
				</td>
			</tr>
			<tr>
				<td class="cell_360">Marque d'imprimante</td>
				<td class="cell_15">S</td>
			</tr>
			
<?php
		
		$i = 0;
		while($m = mysql_fetch_array($res_m))
		{
			echo '<tr>';
			echo '<td><input type="text" class="text_350" maxlength="75" name="marque' .$i .'" id="marque' .$i .'" value="' .$m['LIBELLE_MARQUE'] .'" onblur="Modifier_marque_impr(' .$i .', ' .$m['ID_MARQUE'] .');"/></td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer la marque" onclick="Supprimer_marque_impr(' .$m['ID_MARQUE'] .');" />';
			echo '</tr>';
			echo '<input type="hidden" name="marque' .$i .'h" id="marque' .$i .'h" value="' .$m['LIBELLE_MARQUE'] .'"/>';
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