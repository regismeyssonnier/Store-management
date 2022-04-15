<?php

	session_start();
	
	$con = true;
	if(!isset($_SESSION['connect']))
		$con = false;
	
	session_destroy();
	
	if($con)
		header('Location:index.php');
	else
	{
		include('./CAS/CAS.php');
		/* Initialisation client CAS */
		phpCAS::client(CAS_VERSION_2_0, 'pia.in.ac-dijon.fr', 8443, '', false);
		phpCAS::setLang('french');
		
		phpCAS::logout($_SERVER["SCRIPT_URI"]);
	
	
	}


?>