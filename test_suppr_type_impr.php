<?php

	include('connect.php');

	$sql_tp = "SELECT ID_TYPE_IMPR FROM IMPRIMANTE WHERE ID_TYPE_IMPR = " .$_POST['id_type'];
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