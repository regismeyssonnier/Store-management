<?php

	include('connect.php');

	$sql_tva = "SELECT CODE_TVA FROM CONSOMMABLE WHERE CODE_TVA = " .$_POST['code_tva'];
	$res_t = mysql_query($sql_tva);
	
	if(mysql_num_rows($res_t) > 0)
	{
		echo 'impossible';
	
	}
	else
	{
		echo 'possible';
	
	}




?>