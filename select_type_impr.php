<?php

	include('connect.php');

	$sql_select = "SELECT * FROM TYPE_IMPRIMANTE;";
	$res_t = mysql_query($sql_select);
	
	echo '<select id="type_impr" name="type_impr">';
	while($type_i = mysql_fetch_array($res_t))
	{
		echo '<option value="' .$type_i['ID_TYPE_IMPR'] .'">' .$type_i['LIB_TYPE_IMPR'] .'</option>';
									
	}
	echo '</select>';



?>