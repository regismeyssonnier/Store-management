<?php

	if(isset($_POST['ajax']))
	{
		include('connect.php');
	
	}

	$sql_select = "SELECT * FROM TVA;";
	$res_t = mysql_query($sql_select);

	echo '<select name="tva" id="tva">';
	while($tva = mysql_fetch_array($res_t))
	{
		echo '<option value="' .$tva['CODE_TVA'] .'">' .$tva['TAUX_TVA'] .'</option>';
									
	}
	echo '</select>';

?>