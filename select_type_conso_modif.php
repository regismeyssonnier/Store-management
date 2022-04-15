<?php

	include('connect.php');
	
	$sql_tp_c = "SELECT ID_TYPE FROM CONSOMMABLE WHERE REFERENCE = '" .$_POST['ref'] ."';";
	$res_tp = mysql_query($sql_tp_c);
	$tp_c = mysql_fetch_array($res_tp);

	$sql_select = "SELECT * FROM TYPE_CONSO;";
	$res_t = mysql_query($sql_select);
	
	echo '<select name="type_conso" onchange="Modif_valider_type_conso();">';
	while($type_c = mysql_fetch_array($res_t))
	{
		if($type_c['ID_TYPE'] == $tp_c['ID_TYPE'])
		{
			echo '<option value="' .$type_c['ID_TYPE'] .'" selected="selected">' .$type_c['LIBELLE_TYPE'] .'</option>';
		}		
		else
		{
			echo '<option value="' .$type_c['ID_TYPE'] .'">' .$type_c['LIBELLE_TYPE'] .'</option>';
		}
		
	}
	echo '</select>';















?>