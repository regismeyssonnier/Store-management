<?php

	include('connect.php');

	$sql_tva = "SELECT * FROM TVA WHERE TAUX_TVA = " .$_POST['taux_tva'];
	$res_t = mysql_query($sql_tva);
	
	if(mysql_num_rows($res_t) > 0)
	{
		echo "existe";
	
	}
	else
	{
		echo "libre";
	
	}
	


?>