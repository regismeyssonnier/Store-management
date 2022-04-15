<?php

	include('connect.php');

	$sql_m = "SELECT ID_MARQUE FROM IMPRIMANTE WHERE ID_MARQUE = " .$_POST['id_marque'];
	$res_m = mysql_query($sql_m);
	
	if(mysql_num_rows($res_m) > 0)
	{
		echo 'impossible';
	
	}
	else
	{
		echo 'possible';
	
	}




?>