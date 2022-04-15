<?php

	if(isset($_POST['ajax']))
	{
		include('connect.php');
	}

	$sql_division = "SELECT * FROM DIVISION_ARCHIVE ORDER BY ID_DIVISION;";
	$res_d = mysql_query($sql_division);
	
	echo '<select name="divisiona" id="divisiona" >';
	while($division = mysql_fetch_array($res_d))
	{
		echo '<option value="' .$division['ID_DIVISION'] .'">' .$division['ID_DIVISION'] .'</option>';								
	}
	echo '</select>';

?>