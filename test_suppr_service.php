<?php

	include('connect.php');
	
	$suppr = true;

	$sql = "SELECT ID_SERVICE FROM UTILISATEUR WHERE ID_SERVICE = '" .$_POST['id_service'] ."';";
	$res = mysql_query($sql);
	
	if(mysql_num_rows($res) > 0)
	{
		$suppr = false;
	
	}
	
	$sql_c = "SELECT ID_SERVICE FROM CONSOMMER WHERE ID_SERVICE = '" .$_POST['id_service'] ."';";
	$res_c = mysql_query($sql_c);
	
	if(mysql_num_rows($res_c) > 0)
	{
		$suppr = false;
	
	}
	
	$sql_s = "SELECT ID_SERVICE FROM IMPR_EN_SERVICE WHERE ID_SERVICE = '" .$_POST['id_service'] ."';";
	$res_s= mysql_query($sql_s);
	
	if(mysql_num_rows($res_s) > 0)
	{
		$suppr = false;
	
	}
	
	if($suppr)
		echo "possible";
	else
		echo "impossible";
		
	
	
?>