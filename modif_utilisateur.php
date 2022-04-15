<?php

	include('connect.php');
	
	$sql_up = "UPDATE UTILISATEUR 
			   SET NOM_UTILISATEUR = '" .utf8_decode($_POST['nom']) ."'
			   , PRENOM_UTILISATEUR = '" .utf8_decode($_POST['prenom']) ."'
			   , LOGIN_UTILISATEUR = '" .$_POST['login'] ."'
			   , ID_SERVICE = '" .$_POST['service'] ."'
			   , ID_TYPE_UTIL = " .$_POST['tp_util']
			  ." WHERE ID_UTILISATEUR = " .$_POST['id_util'] .";";
	mysql_query($sql_up)or die ($sql_up);
	


?>