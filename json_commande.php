<?php

	include('connect.php');

	$sql_com = "SELECT * FROM COMMANDE;";
	$res_c = mysql_query($sql_com);
		 
	echo '{commande:[';
	echo "['Aucune','Aucune']";
	while($commande = mysql_fetch_array($res_c))
	{
		echo ",['" .$commande['NUM_COMMANDE'] ."','" .$commande['NUM_COMMANDE'] ."']";
		
	}
	echo "]}";
	 
	 









?>