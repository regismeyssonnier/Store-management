<?php

	include('connect.php');

	$sql = "SELECT * FROM SERVICE WHERE ID_SERVICE = '" .$_POST['id_service'] ."';";
	$res = mysql_query($sql);
	
	if(mysql_num_rows($res) > 0)
	{
		echo "existe";
	
	}
	else
	{
		echo "libre";
	
	}
	


?>