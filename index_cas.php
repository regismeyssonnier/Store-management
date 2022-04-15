<?php

	
	include('./CAS/CAS.php');

	/* Initialisation client CAS */
	phpCAS::client(CAS_VERSION_2_0, 'pia.in.ac-dijon.fr', 8443, '', true);
	phpCAS::setLang('french');

	/* l'utilisateur est dèjà authentifié CAS ? */
	if (phpCAS::isAuthenticated())
	{
		if(!isset($_SESSION['login']))
		{
			$sql_auth = "SELECT LOGIN_UTILISATEUR FROM UTILISATEUR WHERE LOGIN_UTILISATEUR = '" .addslashes(phpCAS::getUser()) ."'";
			$res_a = mysql_query($sql_auth);
			if(mysql_num_rows($res_a) == 0)
			{
				header('Refresh:0; URL=interdiction_acces.php');
			}
			else
			{
				
				$serveur = "ldap://aristote.dijon.men.fr";
				$port = "389";
				$dn="ou=ac-dijon, ou=education, o=gouv, c=fr"; 
				
				$ldap = new Ldap($serveur, $port);
				$ldap->Connecter_serveur();
				$r_ld = $ldap->Authentifier_utilisateur($_POST['login'], $dn);
				
				if($r_ld->resultat)
				{	
					$sql_type_util = "SELECT * 
									  FROM UTILISATEUR AS U, TYPE_UTIL AS T
									  WHERE U.ID_TYPE_UTIL = T.ID_TYPE_UTIL
									  AND LOGIN_UTILISATEUR = '" .$_POST['login'] ."';";
					
					$res_t = mysql_query($sql_type_util);
					$type = mysql_fetch_array($res_t);
					$_SESSION['id_util'] = $type['ID_UTILISATEUR'];
					$_SESSION['type_util'] = $type['LIBELLE_TYPE_UTIL'];
				
					$mess_auth = $r_ld->message;
					$_SESSION['login'] = $ldap->login;
					$_SESSION['nom'] = $ldap->nom;
					$_SESSION['prenom'] = $ldap->prenom;
					$_SESSION['email'] = $ldap->email;
					$_SESSION['dn_perso'] = $ldap->nom;
					
				}
				
				$ldap->Deconnecter_serveur();
				
			}	
					
			
		}
		
	}
	else if(!phpCAS::isSessionAuthenticated())
	{
		
		phpCAS::forceAuthentication();  
	
	}


















?>