<?php

	include('connect.php');

	
	$sql_del = "DELETE FROM LIVRAISON WHERE NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
	mysql_query($sql_del)or die($sql_del);
	
	$sql_del_l = "DELETE FROM LIVRER WHERE NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
	mysql_query($sql_del_l)or die($sql_del_l);
	
	$sql_del_r = "DELETE FROM RECEVOIR WHERE NUM_LIVRAISON = '" .$_POST['num_livr'] ."';";
	mysql_query($sql_del_r)or die($sql_del_r);
	
	echo 'reussi';
			
	














?>