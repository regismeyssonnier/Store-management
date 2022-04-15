<?php

	include('connect.php');
		

	$sql = "SELECT ID_DIVISION FROM SERVICE WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
	$res = mysql_query($sql);
	
	if(mysql_num_rows($res) > 0)
	{
		echo "impossible";
	
	}
	else
	{
		echo "possible";
	}

	

	
?>