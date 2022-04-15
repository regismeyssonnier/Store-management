<?php

	include('connect.php');
	
	$modif = true;
	
	$livrer = 0;
	$sql_livr = "SELECT * FROM CONSOMMABLE AS C, LIVRER AS L WHERE C.REFERENCE = L.REFERENCE AND C.REFERENCE = '" .$_POST['reference'] ."';";
	$res_l = mysql_query($sql_livr);
	if(mysql_num_rows($res_l) > 0)
	{
		$livrer = 1;
		$modif = false;
	}
	
	$commande = 0;
	$sql_comm = "SELECT * FROM CONSOMMABLE AS C, CONTENIR AS CO WHERE C.REFERENCE = CO.REFERENCE AND C.REFERENCE = '" .$_POST['reference'] ."';";
	$res_c = mysql_query($sql_comm);
	if(mysql_num_rows($res_c) > 0)
	{
		$commande = 1;
		$modif = false;
	}
	
	$consomme = 0;
	$sql_cons = "SELECT * FROM CONSOMMABLE AS C, CONSOMMER AS CO WHERE C.REFERENCE = CO.REFERENCE AND C.REFERENCE = '" .$_POST['reference'] ."';";
	$res_co = mysql_query($sql_cons);
	if(mysql_num_rows($res_co) > 0)
	{
		$consomme = 1;
		$modif = false;
	}
	
	$demande = 0;
	$sql_dem = "SELECT * FROM CONSOMMABLE AS C, DEMANDER AS D WHERE C.REFERENCE = D.REFERENCE AND C.REFERENCE = '" .$_POST['reference'] ."';";
	$res_d = mysql_query($sql_dem);
	if(mysql_num_rows($res_d) > 0)
	{
		$demande = 1;
		$modif = false;
	}
	
		
	if($modif)
	{
		$sql_login = "SELECT REFERENCE FROM CONSOMMABLE WHERE REFERENCE = '" .$_POST['nouv_reference'] ."';";
		$res_l = mysql_query($sql_login);
		
		if(mysql_num_rows($res_l) > 0)
		{
			echo '{"res":"pris"}';
				
		}
		else
		{
			echo '{"res":"libre"}';
		
		}
		
	}
	else
	{
		echo '{"res":"Pas de modif de ref", "livrer":"' .$livrer .'", "commande":"' .$commande .'", "consomme":"' .$consomme .'", "demande":"' .$demande .'"}';
	
	
	}



?>