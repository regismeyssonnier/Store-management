<?php

	if(isset($_POST['ajax']))
	{
		header('Content-Type: text/html; charset=ISO-8859-1'); 
		include('connect.php');
			
	}
	
	if(isset($_POST['division']))
	{
		$sql_ins = "INSERT INTO DIVISION VALUES('" .$_POST['division'] ."', '" .utf8_decode($_POST['nom_division']) ."');";
		mysql_query($sql_ins)or die($sql_ins);
		
		$sql_ins = "INSERT INTO DIVISION_ARCHIVE VALUES('" .$_POST['division'] ."', '" .utf8_decode($_POST['nom_division']) ."', CURDATE(), '');";
		mysql_query($sql_ins);
			
	}
	else if(isset($_POST['suppr']))
	{
		$sql_del = "DELETE FROM DIVISION WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
		mysql_query($sql_del)or die($sql_del);
		
		if($_POST['suppr_archive'] == 1)
		{
			$sql_del = "DELETE FROM DIVISION_ARCHIVE WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
			mysql_query($sql_del)or die($sql_del);
		}
	
	}
	else if(isset($_POST['modif_id']))
	{
		$sql_up = "UPDATE DIVISION 
				   SET ID_DIVISION = '" .$_POST['nv_division'] ."' 
				   WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
		mysql_query($sql_up)or die($sql_up);
		
		$sql_up = "UPDATE SERVICE 
				   SET ID_DIVISION = '" .$_POST['nv_division'] ."' 
				   WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
		mysql_query($sql_up)or die($sql_up);
		
		if($_POST['modif_archive'] == 1)
		{
			$sql_up = "UPDATE DIVISION_ARCHIVE
					   SET ID_DIVISION = '" .$_POST['nv_division'] ."' 
					   WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
			mysql_query($sql_up)or die($sql_up);
		}
		else if($_POST['modif_archive'] == 2)
		{
			$sql_ins = "INSERT INTO DIVISION_ARCHIVE VALUES('" .$_POST['nv_division'] ."', '" .utf8_decode($_POST['nom_division']) ."', CURDATE(), '" .$_POST['id_division'] ."');";
			mysql_query($sql_ins);
		}
			
	
	}
	else if(isset($_POST['modif_nom']))
	{
		$sql_up = "UPDATE DIVISION 
				   SET NOM_DIVISION = '" .$_POST['nom_division'] ."' 
				   WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
		mysql_query($sql_up)or die($sql_up);
		
		if($_POST['modif_archive'] == 1)
		{
			$sql_up = "UPDATE DIVISION_ARCHIVE
					   SET NOM_DIVISION = '" .$_POST['nom_division'] ."' 
					   WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
			mysql_query($sql_up)or die($sql_up);
		}
		
	
	}
	else if(isset($_POST['fusion']))
	{
		$sql_ser = "SELECT * FROM SERVICE WHERE ID_DIVISION = '" .$_POST['division1'] ."' OR ID_DIVISION = '" .$_POST['division2'] ."';";
		$res_s = mysql_query($sql_ser);
		
		if(mysql_num_rows($res_s) > 0)
		{
			while($service = mysql_fetch_array($res_s))
			{
				$sql_up = "UPDATE SERVICE 
						   SET ID_DIVISION = '" .$_POST['division3'] ."'
						   WHERE ID_SERVICE = '" .$service['ID_SERVICE'] ."';";
				mysql_query($sql_up);
			
					   
			}
		
		}
		
		$sql_ins = "INSERT INTO FUSIONNER VALUES('" .$_POST['division1'] ."', '" .$_POST['division2'] ."', '" .$_POST['division3'] ."', CURDATE());";
		mysql_query($sql_ins);
		
		$sql_div = "DELETE FROM DIVISION WHERE ID_DIVISION = '" .$_POST['division1'] ."';";
		mysql_query($sql_div);
		
		$sql_div = "DELETE FROM DIVISION WHERE ID_DIVISION = '" .$_POST['division2'] ."';";
		mysql_query($sql_div);
			
	
	}
	

	$sql = "SELECT *
		    FROM DIVISION
		    ORDER BY ID_DIVISION;";
	
	$res = mysql_query($sql);
	
	if(mysql_num_rows($res) > 0)
	{
?>

		<table class="tab_bleu_575">
			<tr>
				<td class="titre_fond_bleu25" valign="top" colspan="3">
					Division
				</td>
			</tr>
			<tr>
				<td class="cell_560" colspan="2">Division</td>
				<td class="cell_15">S</td>
			</tr>
			
<?php
		
		$i = 0;
		while($s = mysql_fetch_array($res))
		{
			echo '<tr>';
			echo '<td class="">Abbr&eacute;viation Division</td>';
			echo '<td><input type="text" style="background-color:white;border:1px solid #9FBEEC;" class="text_center" size="25" readonly maxlength="25" name="division_' .$i .'" id="division_' .$i .'" value="' .$s['ID_DIVISION'] .'" onblur="Modifier_id_division(' .$i .", '" .$s['ID_DIVISION'] ."'" .');"/></td>';
			echo '<td><img src="Image/suppr.gif" style="cursor:pointer;" title="Supprimer la division" alt="Supprimer la division" onclick="Supprimer_division(' ."'" .$s['ID_DIVISION'] ."'" .');" /></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td class="cell_souligne_bottom">Libell&eacute; Division</td>';
			echo '<td class="cell_souligne_bottom"><input type="text" style="background-color:white;border:1px solid #9FBEEC;" readonly size="60" maxlength="75" name="nom_division' .$i .'" id="nom_division' .$i .'" value="' .$s['NOM_DIVISION'] .'" onblur="Modifier_nom_division(' .$i .", '" .$s['ID_DIVISION'] ."'" .');"/></td>';
			echo '<td class="cell_souligne_bottom"><img src="Image/modif.png" style="cursor:pointer;" title="Modifier la division" alt="Modifier la division" onclick="Modifier_division(' .$i .');" /></td>';
			echo '</tr>';
			
			echo '<input type="hidden" name="division_' .$i .'h" id="division_' .$i .'h" value="' .$s['ID_DIVISION'] .'"/>';
			echo '<input type="hidden" name="nom_division' .$i .'h" id="nom_division' .$i .'h" value="' .$s['NOM_DIVISION'] .'"/>';
			$i++;
		
		}
		
		
?>

		<tr>
			<td class="titre_fond_bleu25" valign="top" colspan="3">
				
			</td>
		</tr>
		</table>


<?php
		
	}

?>