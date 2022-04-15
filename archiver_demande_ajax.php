<?php

	header('Content-Type: text/html; charset=ISO-8859-1'); 
	
	include('connect.php');
	
	$t_d1 = split("/", $_POST['date1']);
	$t_d2 = split("/", $_POST['date2']);
	
	$date1 = $t_d1[2] ."-" .$t_d1[1] ."-" .$t_d1[0];
	$date2 = $t_d2[2] ."-" .$t_d2[1] ."-" .$t_d2[0];

	$sql_dem = "SELECT *
				FROM DEMANDE AS D, POSSEDER AS P
				WHERE DATE_DEMANDE BETWEEN '" .$date1 ."' AND '" .$date2 ."'
				AND D.NUM_DEMANDE = P.NUM_DEMANDE
				AND NUM_ETAT = 3;";
	$res_dem = mysql_query($sql_dem)or die($sql_dem);
	
	if(mysql_num_rows($res_dem) > 0)
	{
		$sql_num = "SELECT MAX(NUM_DEMANDE) FROM DEMANDE_ARCHIVE;";
		$res_n = mysql_query($sql_num);
		$num = mysql_fetch_array($res_n);
		$num_dem = $num[0] + 1;
		
		$nb = 0;		
		while($demande = mysql_fetch_array($res_dem))
		{
			$sql_ds = "SELECT *
					   FROM DIVISION AS D, SERVICE AS S, UTILISATEUR AS U
					   WHERE D.ID_DIVISION = S.ID_DIVISION
					   AND U.ID_SERVICE = S.ID_SERVICE
					   AND ID_UTILISATEUR = " .$demande['ID_UTILISATEUR_FAIRE'];
			$res_ds = mysql_query($sql_ds);
			$ds = mysql_fetch_array($res_ds);
		
			$sql_ins_dem = "INSERT INTO DEMANDE_ARCHIVE VALUES(" .$num_dem .", '" .$demande['DATE_DEMANDE'] ."', '" .$ds['ID_DIVISION'] ."', '" .$ds['ID_SERVICE'] ."');";
			mysql_query($sql_ins_dem)or die($sql_ins_dem);
			
			$sql_d = "SELECT * FROM DEMANDER WHERE NUM_DEMANDE = " .$demande['NUM_DEMANDE'] .";";
			$res_d = mysql_query($sql_d)or die($sql_d);
			
			while($demander = mysql_fetch_array($res_d))
			{
				$sql_ins_d = "INSERT INTO DEMANDER_ARCHIVE VALUES(" .$num_dem .", '" .$demander['REFERENCE'] ."', " .$demander['QTE_DEMANDER'] .", " .$demander['PRIX_CONSO'] .");";
				mysql_query($sql_ins_d)or die($sql_ins_d);
							
			}
			
			$sql_del = "DELETE FROM DEMANDER WHERE NUM_DEMANDE = " .$demande['NUM_DEMANDE'] .";";
			mysql_query($sql_del)or die($sql_del);
			
			$sql_p = "SELECT * FROM POSSEDER WHERE NUM_DEMANDE = " .$demande['NUM_DEMANDE'] .";";
			$res_p = mysql_query($sql_p)or die($sql_p);
			
			while($posseder = mysql_fetch_array($res_p))
			{
				$sql_ins_p = "INSERT INTO POSSEDER_ARCHIVE VALUES(" .$num_dem .", " .$posseder['NUM_ETAT'] .", '" .$posseder['DATE_ETAT'] ."');";
				mysql_query($sql_ins_p)or die($sql_ins_p);
							
			}
			
			$sql_del = "DELETE FROM POSSEDER WHERE NUM_DEMANDE = " .$demande['NUM_DEMANDE'] .";";
			mysql_query($sql_del)or die($sql_del);
			
			$sql_del = "DELETE FROM DEMANDE WHERE NUM_DEMANDE = " .$demande['NUM_DEMANDE'] .";";
			mysql_query($sql_del)or die($sql_del);
									
			$num_dem++;
			$nb++;
		
		}
		
		echo $nb;
	
	}
	else
	{
		echo 0;
	}

	





?>