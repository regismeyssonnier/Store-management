<?php

	if(isset($_POST['ajax']))
	{
		include('connect.php');
	
	}

	$sql_select = "SELECT * FROM TYPE_CONSO;";
	$res_t = mysql_query($sql_select);
	
	echo '<select name="type_conso" id="type_conso">';
	while($type_c = mysql_fetch_array($res_t))
	{
		echo '<option value="' .$type_c['ID_TYPE'] .'">' .$type_c['LIBELLE_TYPE'] .'</option>';
									
	}
	echo '</select>';

?>