<?php

	include('connect.php');
	
		
	$sql_impr_serv = "SELECT * FROM IMPR_EN_SERVICE WHERE REF_IMPRIMANTE = '" .$_POST['ref_impr'] ."';";
	$res_i = mysql_query($sql_impr_serv);
	
	if(mysql_num_rows($res_i) > 0)
	{
		echo '{res:"impossible"}';
	
	}
	else
	{
		$sql_del = "DELETE FROM IMPRIMANTE WHERE REF_IMPRIMANTE = '" .$_POST['ref_impr'] ."';";
		mysql_query($sql_del);
		
		echo '{res:"supprimer"}';
				
	}
	
	

?>