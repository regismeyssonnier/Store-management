<?php

	include('connect.php');
	
	$sql_up  = "UPDATE CONSOMMABLE "; 
	$sql_up .= "SET REFERENCE = '" .$_POST['reference'] ."' ";
	$sql_up .= ", DESIGNATION = '" .addslashes($_POST['designation']) ."' ";
	$sql_up .= ", PRIX_UNITAIRE = " .$_POST['pu'];
	$sql_up .= ", LOT = " .$_POST['lot'];
	$sql_up .= ", QTE_STOCK = " .$_POST['qte_stock'];
	$sql_up .= ", SEUIL_REAP = " .$_POST['seuil_reap'];
	$sql_up .= ", COMMENTAIRE = '" .addslashes($_POST['commentaire']) ."' ";
	$sql_up .= ", CODE_TVA = " .$_POST['tva'];
	$sql_up .= ", ID_TYPE = " .$_POST['type_conso'] ." ";
	$sql_up .= "WHERE REFERENCE = '" .$_POST['conso_ref'] ."';";
			 
	mysql_query($sql_up)or die('{"resultat":"Echec modification", "err":"' .mysql_error() .'"}');
	
	echo '{"resultat":"Reussite modification", "res":"' .$sql_up .'"}';

?>