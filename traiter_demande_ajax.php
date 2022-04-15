<?php

	session_start();

	header('Content-Type: text/html; charset=ISO-8859-1'); 
	include('connect.php');

	$sql_dem = "SELECT *
				FROM CONSOMMABLE AS C, DEMANDER AS DEM
				WHERE C.REFERENCE = DEM.REFERENCE
				AND NUM_DEMANDE = " .$_POST['num_demande'];
	$res_conso = mysql_query($sql_dem);
	
	$sql_service = "SELECT ID_SERVICE
					FROM DEMANDE AS D, UTILISATEUR AS U
					WHERE D.ID_UTILISATEUR_FAIRE = U.ID_UTILISATEUR
					AND NUM_DEMANDE = " .$_POST['num_demande'];
	$res_s = mysql_query($sql_service)or die($sql_service);
	$service = mysql_fetch_array($res_s);

	$traiter = true;$i = 0;
	while($conso = mysql_fetch_array($res_conso))
	{
		
		if($_SESSION['tab_donner'][$i] > 0)
		{
			$sql_up = "UPDATE CONSOMMABLE
					   SET QTE_STOCK = QTE_STOCK - " .$_SESSION['tab_donner'][$i] ." "
					 ."WHERE REFERENCE = '" .$conso['REFERENCE'] ."';";
			mysql_query($sql_up)or die($sql_up);
					
			$sql_c = "SELECT *
					  FROM CONSOMMER 
					  WHERE REFERENCE = '" .$conso['REFERENCE'] ."'
					  AND NUM_DEMANDE = " .$_POST['num_demande'] .";";
			$res_c = mysql_query($sql_c);
			
			if(mysql_num_rows($res_c) > 0)
			{
				$consomme = mysql_fetch_array($res_c);
				if(($consomme['NB_CONSO'] + $_SESSION['tab_donner'][$i]) < $conso['QTE_DEMANDER'])
					$traiter = false;
					
			
				$sql_up = "UPDATE CONSOMMER
						   SET NB_CONSO = NB_CONSO + " .$_SESSION['tab_donner'][$i] ."
						   , DATE_CONSO = CURDATE()
						   WHERE REFERENCE = '" .$conso['REFERENCE'] ."' 
						   AND NUM_DEMANDE = " .$_POST['num_demande'] .";";
				mysql_query($sql_up)or die($sql_up);
			
			}
			else
			{
				if($_SESSION['tab_donner'][$i] < $conso['QTE_DEMANDER'])
					$traiter = false;
			
				$sql_ins_cons = "INSERT INTO CONSOMMER VALUES('" .$service['ID_SERVICE'] ."', '" .$conso['REFERENCE'] ."', " .$_POST['num_demande'] .", " .$_SESSION['tab_donner'][$i] .", CURDATE(), " .$conso['PRIX_UNITAIRE'] .");";
				mysql_query($sql_ins_cons)or die($sql_ins_cons);
			
			}
		
		}
		else if($_SESSION['tab_retirer'][$i] > 0)
		{
			$sql_up = "UPDATE CONSOMMABLE
					   SET QTE_STOCK = QTE_STOCK + " .$_SESSION['tab_retirer'][$i] ." "
					 ."WHERE REFERENCE = '" .$conso['REFERENCE'] ."';";
			mysql_query($sql_up)or die($sql_up);
			
			$sql_up = "UPDATE CONSOMMER
					   SET NB_CONSO = NB_CONSO - " .$_SESSION['tab_retirer'][$i] ."
					   , DATE_CONSO = CURDATE()
					   WHERE REFERENCE = '" .$conso['REFERENCE'] ."' 
					   AND NUM_DEMANDE = " .$_POST['num_demande'] .";";
			mysql_query($sql_up)or die($sql_up);
			
			$traiter = false;
			
			
		
		}
		
		$i++;
	
	
	}
	
	
	$sql_util_traite = "UPDATE DEMANDE
						SET ID_UTILISATEUR = " .$_SESSION['id_util'] .";";
	mysql_query($sql_util_traite)or die($sql_util_traite);
	
	
	if($traiter)
	{
		$sql_etat = "INSERT INTO POSSEDER VALUES(" .$_POST['num_demande'] .", 3, CURDATE());";
		mysql_query($sql_etat);
		echo "demande traitée";
	
	}
	else
	{
		$sql_etat = "INSERT INTO POSSEDER VALUES(" .$_POST['num_demande'] .", 2, CURDATE());";
		mysql_query($sql_etat);
		
		$sql_del = "DELETE FROM POSSEDER WHERE NUM_DEMANDE = " .$_POST['num_demande'] ." AND NUM_ETAT = 3;";
		mysql_query($sql_del)or die($sql_del);
		
		echo "demande incomplète";
	
	}
	
	
	


?>