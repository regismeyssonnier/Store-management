<?php
	
	include('./CAS/CAS.php');

	/* Initialisation client CAS */
	phpCAS::client(CAS_VERSION_2_0, 'pia.in.ac-dijon.fr', 8443, '', true);
	phpCAS::setLang('french');
	
	phpCAS::logout('');
	
?>