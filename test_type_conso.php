<?php

	include('connect.php');

	$sql_tp = "SELECT * FROM TYPE_CONSO WHERE LIBELLE_TYPE = '" .$_POST['lib_type'] ."';";
	$res_t = mysql_query($sql_tp);
	
	if(mysql_num_rows($res_t) > 0)
	{
		echo "existe";
	
	}
	else
	{
		echo "libre";
	
	}
	


?>