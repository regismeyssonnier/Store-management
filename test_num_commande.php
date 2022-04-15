<?php

	include('connect.php');

	$sql_num_com = "SELECT NUM_COMMANDE FROM COMMANDE WHERE NUM_COMMANDE = '" .$_POST['num_com'] ."';";
	$res_n = mysql_query($sql_num_com);
	
	if(mysql_num_rows($res_n) > 0)
	{
		echo "pris";
	}
	else
	{
		echo "libre";
	}

?>