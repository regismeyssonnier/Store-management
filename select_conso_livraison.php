<?php

	if(isset($_POST['ajax']))
	{
	
		include('connect.php');
	
		$sql_conso = "SELECT *
					  FROM CONSOMMABLE AS C, COMMANDE AS CO, CONTENIR AS CONT
					  WHERE C.REFERENCE = CONT.REFERENCE
					  AND CONT.NUM_COMMANDE = CO.NUM_COMMANDE
					  AND CO.NUM_COMMANDE = '" .$_POST['num_com'] ."';";
					 
		$res_c = mysql_query($sql_conso);

		echo '<select name="conso1" id="conso1" class="select_refdes">';
		while($conso = mysql_fetch_array($res_c))
		{
			echo '<option value="' .$conso['REFERENCE'] .'">' .$conso['REFERENCE'] ." - " .$conso['DESIGNATION'] .'</option>';

		}
	
	}
	else
	{

		$sql_conso = "SELECT *
					  FROM CONSOMMABLE AS C, COMMANDE AS CO, CONTENIR AS CONT
					  WHERE C.REFERENCE = CONT.REFERENCE
					  AND CONT.NUM_COMMANDE = CO.NUM_COMMANDE
					  AND CO.NUM_COMMANDE = '" .$num_com ."';";
					 
		$res_c = mysql_query($sql_conso);

		echo '<select name="conso1" id="conso1" class="select_refdes">';
		while($conso = mysql_fetch_array($res_c))
		{
			echo '<option value="' .$conso['REFERENCE'] .'">' .$conso['REFERENCE'] ." - " .$conso['DESIGNATION'] .'</option>';

		}

	}


?>