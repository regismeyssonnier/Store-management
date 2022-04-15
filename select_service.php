<?php

	if(isset($_POST['ajax']))
	{
	
		include('connect.php');

		$sql_service = "SELECT * FROM SERVICE WHERE ID_DIVISION = '" .$_POST['id_division'] ."';";
		$res_s = mysql_query($sql_service);
		
		echo '<select name="service" id="service">';
		while($service = mysql_fetch_array($res_s))
		{
			echo '<option value="' .$service['ID_SERVICE'] .'">' .$service['ID_SERVICE'] .'</option>';
		}
		echo '</select>';
		
	
	}
	else
	{

		$sql_service = "SELECT * FROM SERVICE WHERE ID_DIVISION = '" .$id_division ."';";
		$res_s = mysql_query($sql_service);
		
		echo '<select name="service" id="service">';
		while($service = mysql_fetch_array($res_s))
		{
			echo '<option value="' .$service['ID_SERVICE'] .'">' .$service['ID_SERVICE'] .'</option>';
		}
		echo '</select>';
		
	}


?>