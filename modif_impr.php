<?php

	include('connect.php');

	$sql_up_i = "UPDATE IMPRIMANTE
				 SET REF_IMPRIMANTE = '" .$_POST['ref_impr'] ."' "
			   .", DESIGNATION_IMPRIMANTE = '" .$_POST['des_impr'] ."' "
			   .", ID_MARQUE = " .$_POST['marque_impr'] 
			   .", ID_TYPE_IMPR = " .$_POST['type_impr'] ." "
			   ."WHERE REF_IMPRIMANTE = '" .$_POST['a_ref_impr'] ."';";
	mysql_query($sql_up_i)or die($sql_up_i);
	
	


?>