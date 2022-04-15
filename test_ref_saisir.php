<?php

	include('connect.php');

	$sql_login = "SELECT REFERENCE FROM CONSOMMABLE WHERE REFERENCE = '" .$_POST['reference'] ."';";
	$res_l = mysql_query($sql_login);
	
	if(mysql_num_rows($res_l) > 0)
	{
		echo "pris";
			
	}
	else
	{
		echo "libre";
	
	}

?>