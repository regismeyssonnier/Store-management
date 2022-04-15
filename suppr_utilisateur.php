<?php

	include('connect.php');

	$sql_del = "DELETE FROM UTILISATEUR WHERE ID_UTILISATEUR = " .$_POST['id_util'] .";";
	mysql_query($sql_del)or die($sql_del);
	
	echo '{res:"supprimer"}';


?>