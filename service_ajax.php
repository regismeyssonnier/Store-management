<?php

	if(isset($_POST['ajax']))
	{
		header('Content-Type: text/html; charset=ISO-8859-1'); 
		include('connect.php');
		
		$id_division = $_POST['id_division'];
	}
	
	if(isset($_POST['id_service']))
	{
		$sql_ins = "INSERT INTO SERVICE VALUES('" .$_POST['id_service'] ."', '" .$_POST['id_division'] ."', '" .utf8_decode($_POST['nom_service']) ."');";
		mysql_query($sql_ins)or die($sql_ins);
			
	}
	else if(isset($_POST['suppr']))
	{
		$sql_del = "DELETE FROM SERVICE WHERE ID_SERVICE = '" .$_POST['service'] ."';";
		mysql_query($sql_del)or die($sql_del);
	
	}
	else if(isset($_POST['modif_id']))
	{
		$sql_up = "UPDATE SERVICE 
				   SET ID_SERVICE = '" .$_POST['nv_service'] ."' 
				   WHERE ID_SERVICE = '" .$_POST['service'] ."';";
		mysql_query($sql_up)or die($sql_up);
		
		$sql_up = "UPDATE UTILISATEUR 
				   SET ID_SERVICE = '" .$_POST['nv_service'] ."' 
				   WHERE ID_SERVICE = '" .$_POST['service'] ."';";
		mysql_query($sql_up)or die($sql_up);
		
		$sql_up = "UPDATE CONSOMMER 
				   SET ID_SERVICE = '" .$_POST['nv_service'] ."' 
				   WHERE ID_SERVICE = '" .$_POST['service'] ."';";
		mysql_query($sql_up)or die($sql_up);
		
		$sql_up = "UPDATE IMPR_EN_SERVICE 
				   SET ID_SERVICE = '" .$_POST['nv_service'] ."' 
				   WHERE ID_SERVICE = '" .$_POST['service'] ."';";
		mysql_query($sql_up)or die($sql_up);
		
	
	}
	else if(isset($_POST['modif_nom']))
	{
		$sql_up = "UPDATE SERVICE 
				   SET NOM_SERVICE = '" .$_POST['nom_service'] ."' 
				   WHERE ID_SERVICE = '" .$_POST['service'] ."';";
		mysql_query($sql_up)or die($sql_up);
		
		
	
	}
	

	$sql = "SELECT *
		    FROM SERVICE
		    WHERE ID_DIVISION = '" .$id_division ."' 
		    ORDER BY ID_SERVICE;";
		
	$res = mysql_query($sql);
	
	if(mysql_num_rows($res) > 0)
	{
?>

		<table class="tab_bleu_575">
			<tr>
				<td class="titre_fond_bleu25" valign="top" colspan="3">
					Service
				</td>
			</tr>
			<tr>
				<td class="cell_560" colspan="2">Service</td>
				<td class="cell_15">S</td>
			</tr>
			
<?php
		
		$i = 0;
		while($s = mysql_fetch_array($res))
		{
			echo '<tr>';
			echo '<td class="">Abbr&eacute;viation Service</td>';
			echo '<td><input type="text" class="text_center" style="background-color:white;border:1px solid #9FBEEC;" readonly size="25" maxlength="25" name="service' .$i .'" id="service' .$i .'" value="' .$s['ID_SERVICE'] .'" onblur="Modifier_id_service(' .$i .", '" .$s['ID_SERVICE'] ."'" .');"/></td>';
			echo '<td><img src="Image/suppr.gif" alt="Supprimer le service" onclick="Supprimer_service(' ."'" .$s['ID_SERVICE'] ."'" .');" /></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td class="cell_souligne_bottom">Libell&eacute; Service</td>';
			echo '<td class="cell_souligne_bottom"><input type="text" style="background-color:white;border:1px solid #9FBEEC;" readonly size="60" maxlength="75" name="nom_service' .$i .'" id="nom_service' .$i .'" value="' .$s['NOM_SERVICE'] .'" onblur="Modifier_nom_service(' .$i .", '" .$s['ID_SERVICE'] ."'" .');"/></td>';
			echo '<td class="cell_souligne_bottom"><img src="Image/modif.png" style="cursor:pointer;" title="Modifier le service" alt="Modifier le service" onclick="Modifier_service(' .$i .');" /></td>';
			echo '</tr>';
			
			echo '<input type="hidden" name="service' .$i .'h" id="service' .$i .'h" value="' .$s['ID_SERVICE'] .'"/>';
			echo '<input type="hidden" name="nom_service' .$i .'h" id="nom_service' .$i .'h" value="' .$s['NOM_SERVICE'] .'"/>';
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