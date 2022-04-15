<?php
	
	$serveur = 'localhost';
	$identifiant = 'root';
	$mdp = '';
	$base = 'suivi_conso';
	
	$connect = mysql_connect($serveur, $identifiant, $mdp)or die ("Connexion impossible à la base");
	mysql_select_db($base, $connect)or die("Base inconnue");
	
?>