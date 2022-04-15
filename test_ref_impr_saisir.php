<?php

	include('connect.php');

	$sql_ref = "SELECT REF_IMPRIMANTE FROM IMPRIMANTE WHERE REF_IMPRIMANTE = '" .$_POST['ref_impr'] ."';";
	$res_r = mysql_query($sql_ref);
	
	if(mysql_num_rows($res_r) > 0)
	{
		echo "pris";
			
	}
	else
	{
		echo "libre";
	
	}

?>