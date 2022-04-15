<?php

	if(isset($_POST['ajax']))
	{
	
		include('connect.php');

		$sql_conso = "SELECT * 
					  FROM CONSOMMABLE AS C, ASSOCIER AS A
					  WHERE C.REFERENCE = A.REFERENCE
					  AND A.REF_IMPRIMANTE = '" .$_POST['ref_impr'] ."';";
		$res_c = mysql_query($sql_conso);

		echo '<select name="conso_impr" id="conso_impr" class="select_refdes">';
		while($conso = mysql_fetch_array($res_c))
		{
			echo '<option value="' .$conso['REFERENCE'] .'">' .$conso['REFERENCE'] ." - " .$conso['DESIGNATION'] .'</option>';

		}
	
	}
	else
	{

		$sql_conso = "SELECT * 
					  FROM CONSOMMABLE AS C, ASSOCIER AS A
					  WHERE C.REFERENCE = A.REFERENCE
					  AND A.REF_IMPRIMANTE = '" .$ref_impr ."';";
		$res_c = mysql_query($sql_conso);

		echo '<select name="conso_impr" id="conso_impr" class="select_refdes">';
		while($conso = mysql_fetch_array($res_c))
		{
			echo '<option value="' .$conso['REFERENCE'] .'">' .$conso['REFERENCE'] ." - " .$conso['DESIGNATION'] .'</option>';

		}
		
	}

























?>