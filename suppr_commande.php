<?php

	include('connect.php');

	$sql_rec = "SELECT * FROM RECEVOIR WHERE NUM_COMMANDE = '" .$_POST['num_com'] ."';";
	$res_r = mysql_query($sql_rec);

	if(mysql_num_rows($res_r) > 0)
	{
		echo '{res:"impossible"}';
	
	
	}
	else
	{
		$sql_del = "DELETE FROM COMMANDE WHERE NUM_COMMANDE = '" .$_POST['num_com'] ."';";
		mysql_query($sql_del)or die($sql_del);
		
		$sql_del_c = "DELETE FROM CONTENIR WHERE NUM_COMMANDE = '" .$_POST['num_com'] ."';";
		mysql_query($sql_del_c)or die($sql_del_c);
		
		echo '{res:"reussi"}';
			
	}














?>