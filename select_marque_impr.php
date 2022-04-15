<?php

	include('connect.php');

	$sql_select = "SELECT * FROM MARQUE;";
	$res_m = mysql_query($sql_select);
	
	echo '<select id="marque" name="marque">';
	while($marque = mysql_fetch_array($res_m))
	{
		echo '<option value="' .$marque['ID_MARQUE'] .'">' .$marque['LIBELLE_MARQUE'] .'</option>';
									
	}
	echo '</select>';



?>