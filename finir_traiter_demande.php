<?php

	session_start();

	include('connect.php');
	
	$sql_conso = "SELECT *
				  FROM CONSOMMABLE AS C, DEMANDER AS DEM
				  WHERE C.REFERENCE = DEM.REFERENCE
				  AND NUM_DEMANDE = " .$_POST['num_demande'];
	$res_c = mysql_query($sql_conso);
	
	$traiter = true;
	
	while($conso = mysql_fetch_array($res_c))
	{
		$sql_consomme = "SELECT *
						 FROM CONSOMMER AS C, DEMANDE AS D
						 WHERE C.NUM_DEMANDE = D.NUM_DEMANDE
						 AND D.NUM_DEMANDE = " .$_POST['num_demande'] ." "
					   ."AND C.REFERENCE = '" .$conso['REFERENCE'] ."';";
		$res_con = mysql_query($sql_consomme)or die($sql_consomme);
		$consomme = mysql_fetch_array($res_con);
		
		
		//Si il reste des consommables non encore fourni entierement
		if($consomme['NB_CONSO'] < $conso['QTE_DEMANDER'])
		{
			$qte_restante = $conso['QTE_DEMANDER'] - $consomme['NB_CONSO'];
			
			if($qte_restante <= $conso['QTE_STOCK'])
			{
				$sql_up = "UPDATE CONSOMMABLE
						   SET QTE_STOCK = QTE_STOCK - " .$qte_restante  ." "
						 ."WHERE REFERENCE = '" .$conso['REFERENCE'] ."';";
				mysql_query($sql_up)or die($sql_up);
				
				$sql_up_cons = "UPDATE CONSOMMER
								SET NB_CONSO = NB_CONSO + " .$qte_restante ." "
							  .", DATE_CONSO = CURDATE() 
							    WHERE REFERENCE = '" .$conso['REFERENCE'] ."' "
							  ."AND NUM_DEMANDE = " .$_POST['num_demande'] .";";
				mysql_query($sql_up_cons)or die($sql_up_cons);
				
					
			
			}
			else
			{
				$sql_up_cons = "UPDATE CONSOMMER
								SET NB_CONSO = NB_CONSO + " .$conso['QTE_STOCK'] ." "
							  .", DATE_CONSO = CURDATE() 
							    WHERE REFERENCE = '" .$conso['REFERENCE'] ."' "
							  ."AND NUM_DEMANDE = " .$_POST['num_demande'] .";";
				mysql_query($sql_up_cons)or die($sql_up_cons);
				
				$sql_up = "UPDATE CONSOMMABLE
						   SET QTE_STOCK = 0
						   WHERE REFERENCE = '" .$conso['REFERENCE'] ."';";
				mysql_query($sql_up)or die($sql_up);
				
				$traiter = false;
			
			
			
			}
		
		}
	
	
	
	}
	
	$sql_util_traite = "UPDATE DEMANDE
						SET ID_UTILISATEUR = " .$_SESSION['id_util'] .";";
	mysql_query($sql_util_traite)or die($sql_util_traite);
	
	if($traiter)
	{
		$sql_etat = "INSERT INTO POSSEDER VALUES(" .$_POST['num_demande'] .", 3, CURDATE());";
		mysql_query($sql_etat)or die($sql_etat);
		echo "demande traiter";
	
	}
	else
	{
		echo "demande toujours incomplete";
	
	}
	






?>