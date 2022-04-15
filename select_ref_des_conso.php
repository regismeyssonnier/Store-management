<?php

	if(isset($_POST['ajax']))
	{
	
		include('connect.php');

		$sql_conso = "SELECT * FROM CONSOMMABLE AS C, TYPE_CONSO AS T WHERE C.ID_TYPE = T.ID_TYPE AND C.ID_TYPE = " .$_POST['id_type'] .";";
		$res_c = mysql_query($sql_conso);

		echo '<select name="conso1" id="conso1" class="select_refdes">';
		while($conso = mysql_fetch_array($res_c))
		{
			echo '<option value="' .$conso['REFERENCE'] .'">' .$conso['REFERENCE'] ." - " .$conso['DESIGNATION'] .'</option>';

		}
	
	}
	else
	{

		$sql_conso = "SELECT * FROM CONSOMMABLE AS C, TYPE_CONSO AS T WHERE C.ID_TYPE = T.ID_TYPE AND C.ID_TYPE = " .$id_type .";";
		$res_c = mysql_query($sql_conso);

		echo '<select name="conso1" id="conso1" class="select_refdes">';
		while($conso = mysql_fetch_array($res_c))
		{
			echo '<option value="' .$conso['REFERENCE'] .'">' .$conso['REFERENCE'] ." - " .$conso['DESIGNATION'] .'</option>';

		}
		
	}

	



?>