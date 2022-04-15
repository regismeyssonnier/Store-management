<?php

	include('connect.php');
	
	$modif = true;
	
	$sql_rec = "SELECT * FROM RECEVOIR WHERE NUM_COMMANDE = '" .$_POST['num_com'] ."';";
	$res_r = mysql_query($sql_rec);

	if(mysql_num_rows($res_r) > 0)
	{
		echo '{res:"impossible"}';
	
	
	}
	else
	{

		$sql_num_com = "SELECT NUM_COMMANDE FROM COMMANDE WHERE NUM_COMMANDE = '" .$_POST['nouv_num_com'] ."';";
		$res_n = mysql_query($sql_num_com);
		
		if(mysql_num_rows($res_n) > 0)
		{
			echo '{res:"pris"}';
		}
		else
		{
			echo '{res:"libre"}';
		}
		
	}

?>