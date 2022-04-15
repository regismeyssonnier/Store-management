<?php

	include('connect.php');

	$sql = "SELECT * FROM DIVISION WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
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