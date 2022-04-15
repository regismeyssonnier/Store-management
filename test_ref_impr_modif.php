<?php

	include('connect.php');
	
	$modif = true;
	
	$sql_impr_serv = "SELECT * FROM IMPR_EN_SERVICE WHERE REF_IMPRIMANTE = '" .$_POST['ref_impr'] ."';";
	$res_i = mysql_query($sql_impr_serv);
	
	if(mysql_num_rows($res_i) > 0)
	{
		echo '{res:"impossible"}';
	
	}
	else
	{
		$sql_ref = "SELECT REF_IMPRIMANTE FROM IMPRIMANTE WHERE REF_IMPRIMANTE = '" .$_POST['nouv_ref'] ."';";
		$res_r = mysql_query($sql_ref);
		
		if(mysql_num_rows($res_r) > 0)
		{
			echo '{res:"pris"}';
				
		}
		else
		{
			echo '{res:"libre"}';
		
		}
		
	}
	
	

?>