<?php

	include('connect.php');

	$sql_tp = "SELECT * FROM TYPE_IMPRIMANTE WHERE LIB_TYPE_IMPR = '" .$_POST['type_impr'] ."';";
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