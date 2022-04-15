<?php

	include('connect.php');

	$sql_num_livr = "SELECT NUM_LIVRAISON FROM LIVRAISON WHERE NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
	$res_n = mysql_query($sql_num_livr);
	
	if(mysql_num_rows($res_n) > 0)
	{
		echo "pris";
	}
	else
	{
		echo "libre";
	}

?>