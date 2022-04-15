<?php

	include('connect.php');

	$sql_tp = "SELECT ID_TYPE FROM CONSOMMABLE WHERE ID_TYPE = " .$_POST['id_type'];
	$res_t = mysql_query($sql_tp);
	
	if(mysql_num_rows($res_t) > 0)
	{
		echo 'impossible';
	
	}
	else
	{
		echo 'possible';
	
	}




?>