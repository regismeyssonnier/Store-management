<?php

	include('connect.php');

	$sql_m = "SELECT * FROM MARQUE WHERE LIBELLE_MARQUE = '" .$_POST['marque'] ."';";
	$res_m = mysql_query($sql_m);
	
	if(mysql_num_rows($res_m) > 0)
	{
		echo "existe";
	
	}
	else
	{
		echo "libre";
	
	}
	


?>